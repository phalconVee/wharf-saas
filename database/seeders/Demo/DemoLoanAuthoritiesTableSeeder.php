<?php

namespace Database\Seeders\Demo;

use Illuminate\Database\Seeder;

class DemoLoanAuthoritiesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('loan_authorities')->delete();

        \DB::table('loan_authorities')->insert([
            0 => [
                'id' => 1,
                'name' => 'Valley National Bank',
                'slug' => 'valley-national-bank',
                'email' => 'vnb@bank.com',
                'contact_number' => '017000000',
                'cc_limit' => '10000000.00',
                'address' => 'New Jersey',
                'note' => '',
                'status' => 1,
                'created_at' => '2022-05-01 05:14:42',
                'updated_at' => '2022-05-01 05:14:42',
            ],
            1 => [
                'id' => 2,
                'name' => 'PNC Bank',
                'slug' => 'pnc-bank',
                'email' => 'pnc@bank.com',
                'contact_number' => '018000000',
                'cc_limit' => '10000000.00',
                'address' => 'Pittsburgh, Pennsylvania',
                'note' => '',
                'status' => 1,
                'created_at' => '2022-05-01 05:15:10',
                'updated_at' => '2022-05-01 05:15:10',
            ],
        ]);
    }
}
