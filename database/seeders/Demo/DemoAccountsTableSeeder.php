<?php

namespace Database\Seeders\Demo;

use Illuminate\Database\Seeder;

class DemoAccountsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('accounts')->delete();

        \DB::table('accounts')->insert([
            0 => [
                'id' => 4,
                'bank_name' => 'Cash',
                'branch_name' => 'Office',
                'account_number' => 'CASH-0001',
                'slug' => 'cash-0001',
                'date' => '2022-04-30',
                'note' => '',
                'status' => 1,
                'created_at' => '2022-04-30 22:26:01',
                'updated_at' => '2022-04-30 22:26:01',
                'created_by' => 1,
            ],
            1 => [
                'id' => 2,
                'bank_name' => 'Fifth Third Bank',
                'branch_name' => 'Ohio',
                'account_number' => 'FTB-0003',
                'slug' => 'ftb-0002',
                'date' => '2022-04-30',
                'note' => '',
                'status' => 1,
                'created_at' => '2022-04-30 22:24:29',
                'updated_at' => '2022-04-30 22:26:19',
                'created_by' => 1,
            ],
            2 => [
                'id' => 3,
                'bank_name' => 'Wintrust Bank',
                'branch_name' => 'Illinois',
                'account_number' => 'WB-0002',
                'slug' => 'wb-0003',
                'date' => '2022-04-30',
                'note' => '',
                'status' => 1,
                'created_at' => '2022-04-30 22:25:41',
                'updated_at' => '2022-04-30 22:26:10',
                'created_by' => 1,
            ],
        ]);
    }
}
