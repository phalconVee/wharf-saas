<?php

namespace App\Http\Controllers;

use Stripe\Stripe;

use App\Models\Plan;
use App\Models\Payment;
use App\Models\GeneralSetting;
use App\Models\CentralCurrency;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Facades\PayPal;
use Stripe\Checkout\Session as StripeSession;
use App\Http\Resources\CentralCurrencyResource;

class PaymentController extends Controller
{
    // central panel active currency
    public function centralActiveCurrency()
    {
        $activeCurrencyID = tenancy()->central(fn () => GeneralSetting::where('key', 'default_currency')->first()->value);

        $currency = tenancy()->central(fn () => CentralCurrency::where('id', $activeCurrencyID)->first());
        return $currency;
    }

    public function currencyConvert()
    {
        $activeCurrencyID = tenancy()->central(fn () => GeneralSetting::where('key', 'default_currency')->first()->value);
        $currency = tenancy()->central(fn () => CentralCurrency::where('id', $activeCurrencyID)->first());

        $endpoint = 'convert';
        $access_key = env('EXCHANGE_RATES_API_KEY');

        $from = 'USD';
        $to = $currency->code; // central active/default currency
        $amount = 1;

        $ch = curl_init('http://api.exchangerate.host/' . $endpoint . '?access_key=' . $access_key . '&from=' . $from . '&to=' . $to . '&amount=' . $amount . '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($ch);
        curl_close($ch);

        $conversionResult = json_decode($json, true);
        return $conversionResult['result'];
    }

    public function pay($planId, $quantity, $paymentMethod)
    {
        $EXCHANGE_LIVE_CURRENCY = env('EXCHANGE_LIVE_CURRENCY');
        $EXCHANGE_RATES_API_KEY = env('EXCHANGE_RATES_API_KEY');

        $centralActiveCurrency =  $this->centralActiveCurrency();
        if ($EXCHANGE_LIVE_CURRENCY && !empty($EXCHANGE_RATES_API_KEY)) {
            $rate = $this->currencyConvert();
        } else {
            $rate = $centralActiveCurrency->rate;
        }

        $tenant = tenant();

        $plan = tenancy()->central(function () use ($planId) {
            return Plan::findOrFail($planId);
        });

        DB::beginTransaction();

        $payment = tenancy()->central(function () use ($tenant, $plan, $quantity, $paymentMethod, $rate) {
            return Payment::create([
                'tenant_id' => $tenant->id,
                'plan_id' => $plan->id,
                'quantity' => $quantity,
                'method' => $paymentMethod,
                'currency' => $plan->currency,
                'amount' => $plan->amount / $rate,
                'default_amount_rate' => $plan->amount,
            ]);
        });

        if ($paymentMethod === 'stripe') {
            Stripe::setApiKey(config('payment-methods.stripe.secret'));

            $session = StripeSession::create([
                'client_reference_id' => $payment->system_trx_id,
                'customer_email' => auth()->user()->email,
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => $plan->currency,
                            'unit_amount' => number_format(
                                $plan->amount / $rate * 100,
                                0,
                                '.',
                                ''
                            ),
                            'product_data' => [
                                'name' => $plan->name,
                                'description' => $plan->description,
                            ],
                        ],
                        'quantity' => $quantity,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe.cancel'),
            ]);

            return response()->json(['url' => $session->url]);
        } else if ($paymentMethod === 'paypal') {
            // Through facade. No need to import namespaces
            $provider = PayPal::setProvider();
            $accessToken = $provider->getAccessToken();
            $provider->setAccessToken($accessToken);
            $paypalOrder = $provider->createOrder([
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    [
                        'amount' => [
                            'currency_code' => 'USD',
                            'value' => number_format($plan->amount / $rate * $quantity, 2, '.', '')
                        ],
                        'reference_id' => $payment->system_trx_id,
                    ]
                ],
                'application_context' => [
                    'cancel_url' => route('paypal.cancel'),
                    'return_url' => route('paypal.success'),
                ]
            ]);

            // $paypalOrder_id = $paypalOrder['id'];
            $redirectUrl = $paypalOrder['links'][1]['href'];
            return response()->json(['url' => $redirectUrl]);
        }

        return $this->responseWithError('Payment method not supported');
    }
}
