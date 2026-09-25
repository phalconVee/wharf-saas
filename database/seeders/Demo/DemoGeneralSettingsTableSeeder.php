<?php

namespace Database\Seeders\Demo;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoGeneralSettingsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        // check if table is empty
        if (DB::table('general_settings')->count() == 0) {

            // seed basic data to table
            $settingElemetns = [
                'company_name' => 'Wharf HQ',
                'company_tagline' => 'AI Powered Financial Infrastructure for Trade Business',
                'email_address' => 'support@wharfhq.com',
                'phone_number' => '6918917190',
                'address' => '7906 Vernon Avenue Michigan City, IN 46360',
                'client_prefix' => 'AC',
                'supplier_prefix' => 'AS',
                'employee_prefix' => 'AE',
                'product_cat_prefix' => 'APC',
                'product_sub_cat_prefix' => 'APS',
                'product_prefix' => 'AP',
                'exp_cat_prefix' => 'AEC',
                'exp_sub_cat_prefix' => 'AES',
                'pur_prefix' => 'APP',
                'pur_return_prefix' => 'APR',
                'quotation_prefix' => 'APQ',
                'invoice_prefix' => 'AI',
                'invoice_return_prefix' => 'AIR',
                'adjustment_prefix' => 'AIA',
                'default_currency' => '1',
                'default_language' => 'en',
                'logo' => 'images/central-logo-1731390892.png',
                'logo_black' => 'images/central-logo-black-1731390892.png',
                'small_logo' => 'images/central-small-logo.png',
                'favicon' => 'images/central-favicon-1731390892.png',
                'copyright' => 'copyright',
                'default_client_slug' => 'walking-customer',
                'default_account_slug' => 'cash-0001',
                'default_vat_rate_slug' => 'vat-0',
            ];

            foreach ($settingElemetns as $key => $value) {
                DB::table('general_settings')->insert([
                    [
                        'key' => $key,
                        'display_name' => ucwords(str_replace('_', ' ', $key)),
                        'value' => $value,
                    ],
                ]);
            }
        }
    }
}
