<?php

use App\Models\Currency;
use App\Models\GeneralSetting;
use Illuminate\Support\Collection;
use App\Http\Resources\CurrencyResource;
use App\Http\Controllers\PaymentController;

if (! function_exists('arrayToCollection')) {
    function arrayToCollection(array $array): Collection
    {
        return collect(json_decode(json_encode($array), false));
    }
}

if (! function_exists('getActivePaymentMethods')) {
    function getActivePaymentMethods(): Collection
    {
        return arrayToCollection(array_filter(config('payment-methods'), function ($paymentMethod) {
            return $paymentMethod['is_active'];
        }));
    }
}


if (! function_exists('formatCurrency')) {
    function formatCurrency($value)
    {
        $currencyPosition = config('config.currencyPosition');
        $currencySymbol = config('config.currencySymbol');
        if ($currencyPosition == 'left') {
            return $currencySymbol . number_format($value, 2, '.', ',');
        }else{
            return number_format($value, 2, '.', ',') .  $currencySymbol;
        }
    }

}

function getGeneralSettingsInfo()
{
    $query = GeneralSetting::get();
    $settings = [
        'companyName' => $query->where('key', 'company_name')->first()->value,
        'companyTagline' => $query->where('key', 'company_tagline')->first()->value,
        'email' => $query->where('key', 'email_address')->first()->value,
        'phone' => $query->where('key', 'phone_number')->first()->value,
        'address' => $query->where('key', 'address')->first()->value,
        'clientPrefix' => $query->where('key', 'client_prefix')->first()->value,
        'supplierPrefix' => $query->where('key', 'supplier_prefix')->first()->value,
        'employeePrefix' => $query->where('key', 'employee_prefix')->first()->value,
        'proCatPrefix' => $query->where('key', 'product_cat_prefix')->first()->value,
        'proSubCatPrefix' => $query->where('key', 'product_sub_cat_prefix')->first()->value,
        'productPrefix' => $query->where('key', 'product_prefix')->first()->value,
        'expCatPrefix' => $query->where('key', 'exp_cat_prefix')->first()->value,
        'expSubCatPrefix' => $query->where('key', 'exp_sub_cat_prefix')->first()->value,
        'purchasePrefix' => $query->where('key', 'pur_prefix')->first()->value,
        'purchaseReturnPrefix' => $query->where('key', 'pur_return_prefix')->first()->value,
        'quotationPrefix' => $query->where('key', 'quotation_prefix')->first()->value,
        'invoicePrefix' => $query->where('key', 'invoice_prefix')->first()->value,
        'invoiceReturnPrefix' => $query->where('key', 'invoice_return_prefix')->first()->value,
        'adjustmentPrefix' => $query->where('key', 'adjustment_prefix')->first()->value,
        'currency' => new CurrencyResource(Currency::where(
            'id',
            (int) $query->where('key', 'default_currency')->first()->value
        )->first()),
        'language' => $query->where('key', 'default_language')->first()->value,
        'logo' => asset('images/' . $query->where('key', 'logo')->first()->value),
        'blackLogo' => asset('images/' . $query->where('key', 'logo_black')->first()->value),
        'smallLogo' => asset('images/' . $query->where('key', 'small_logo')->first()->value),
        'favicon' => asset('images/' . $query->where('key', 'favicon')->first()->value),
        'copyright' => $query->where('key', 'copyright')->first()->value,
        'defaultClientSlug' => $query->where('key', 'default_client_slug')->first()->value,
        'defaultAccountSlug' => $query->where('key', 'default_account_slug')->first()->value,
        'defaultVatRateSlug' => $query->where('key', 'default_vat_rate_slug')->first()->value,
    ];

    return $settings;
}


function centralCurrencySymbolFormat($amount){
    $paymentController = new PaymentController();
    $centralActiveCurrency = $paymentController->centralActiveCurrency();

     // Format the amount based on the central currency position
     $currencyPosition = $centralActiveCurrency->position;
     if ($currencyPosition === 'left') {
         $formattedPendingAmount = $centralActiveCurrency->symbol . number_format($amount, 2);
     } else {
         $formattedPendingAmount = number_format($amount, 2) . $centralActiveCurrency->symbol;
     }
     return $formattedPendingAmount;
}


function centralCurrencyCodeFormat($amount){
    $paymentController = new PaymentController();
    $centralActiveCurrency = $paymentController->centralActiveCurrency();

     // Format the amount based on the central currency position
     $currencyPosition = $centralActiveCurrency->position;
     if ($currencyPosition === 'left') {
         $formattedPendingAmount = $centralActiveCurrency->code . ' ' . number_format($amount, 2);
     } else {
         $formattedPendingAmount = number_format($amount, 2) . ' ' . $centralActiveCurrency->code;
     }
     return $formattedPendingAmount;
}