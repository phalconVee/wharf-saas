<?php

namespace App\Http\Controllers\Central;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class PaymentMethodController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        $editor = DotenvEditor::load();

        $data['MANUAL_PAYMENT_IS_ACTIVE'] = $editor->getKey('MANUAL_PAYMENT_IS_ACTIVE');
        $data['MANUAL_PAYMENT_NOTE'] = $editor->getKey('MANUAL_PAYMENT_NOTE');
        $data['STRIPE_IS_ACTIVE'] = $editor->getKey('STRIPE_IS_ACTIVE');
        $data['STRIPE_KEY'] = $editor->getKey('STRIPE_KEY');
        $data['STRIPE_SECRET'] = $editor->getKey('STRIPE_SECRET');
        $data['STRIPE_WEBHOOK_SECRET'] = $editor->getKey('STRIPE_WEBHOOK_SECRET');


        $data['PAYPAL_IS_ACTIVE'] = $editor->getKey('PAYPAL_IS_ACTIVE');
        $data['PAYPAL_MODE'] = $editor->getKey('PAYPAL_MODE');

        $data['EXCHANGE_LIVE_CURRENCY'] = $editor->getKey('EXCHANGE_LIVE_CURRENCY');
        $data['EXCHANGE_RATES_API_KEY'] = $editor->getKey('EXCHANGE_RATES_API_KEY');

        if ($data['PAYPAL_MODE']['value'] === 'sandbox') {
            $data['PAYPAL_CLIENT_ID'] = $editor->getKey('PAYPAL_SANDBOX_CLIENT_ID');
            $data['PAYPAL_CLIENT_SECRET'] = $editor->getKey('PAYPAL_SANDBOX_CLIENT_SECRET');
        } else {
            $data['PAYPAL_CLIENT_ID'] = $editor->getKey('PAYPAL_LIVE_CLIENT_ID');
            $data['PAYPAL_CLIENT_SECRET'] = $editor->getKey('PAYPAL_LIVE_CLIENT_SECRET');
        }

        return $this->responseWithSuccess('Data retrieved successfully', $data);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $editor = DotenvEditor::load();
        $editor->setKey('MANUAL_PAYMENT_IS_ACTIVE', $request->integer('MANUAL_PAYMENT_IS_ACTIVE'));
        $editor->setKey('MANUAL_PAYMENT_NOTE', $request->input('MANUAL_PAYMENT_NOTE'));
        $editor->setKey('STRIPE_IS_ACTIVE', $request->integer('STRIPE_IS_ACTIVE'));
        $editor->setKey('STRIPE_KEY', $request->input('STRIPE_KEY'));
        $editor->setKey('STRIPE_SECRET', $request->input('STRIPE_SECRET'));
        $editor->setKey('STRIPE_WEBHOOK_SECRET', $request->input('STRIPE_WEBHOOK_SECRET'));

        $editor->setKey('PAYPAL_IS_ACTIVE', $request->integer('PAYPAL_IS_ACTIVE'));
        $editor->setKey('PAYPAL_MODE', $request->input('PAYPAL_MODE'));

        $editor->setKey('EXCHANGE_LIVE_CURRENCY', $request->integer('EXCHANGE_LIVE_CURRENCY'));
        $editor->setKey('EXCHANGE_RATES_API_KEY', $request->input('EXCHANGE_RATES_API_KEY'));

        if ($request->input('PAYPAL_MODE') === 'sandbox') {
            $editor->setKey('PAYPAL_SANDBOX_CLIENT_ID', $request->input('PAYPAL_CLIENT_ID'));
            $editor->setKey('PAYPAL_SANDBOX_CLIENT_SECRET', $request->input('PAYPAL_CLIENT_SECRET'));
        } else {
            $editor->setKey('PAYPAL_LIVE_CLIENT_ID', $request->input('PAYPAL_CLIENT_ID'));
            $editor->setKey('PAYPAL_LIVE_CLIENT_SECRET', $request->input('PAYPAL_CLIENT_SECRET'));
        }

        $editor->save();

        return $this->responseWithSuccess('Updated successfully!');
    }
}