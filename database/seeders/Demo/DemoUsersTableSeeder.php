<?php

namespace Database\Seeders\Demo;

use Illuminate\Database\Seeder;

class DemoUsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        \DB::table('users')->insert([
            0 => [
                'id' => 1,
                'name' => tenant()->name,
                'email' => tenant()->email,
                'email_verified_at' => '2022-04-30 22:13:36',
                'password' => tenant()->password,
                'remember_token' => null,
                'account_role' => 1,
                'is_active' => 1,
                'slug' => 'super-admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            1 => [
                'id' => 2,
                'name' => 'Whilemina Watts',
                'email' => 'Whilemina@mailinator.com',
                'email_verified_at' => null,
                'password' => '$2y$10$jn0Si9GEEspQCwBtK1U19e398DDfSw0Iq/UrOobFj1XY9sfn8/R9q',
                'remember_token' => null,
                'account_role' => 0,
                'is_active' => 1,
                'slug' => 'whilemina',
                'created_at' => now(),
                'updated_at' => now(),
            ],
             2=> [
                'id' => 3,
                'name' => 'Sales',
                'email' => 'sales@wharfhq.com',
                'email_verified_at' => null,
                'password' => '$2y$10$n7TDzqV8Auj5A6kg6S2iK.LRCCyNB.anDj0m8EVh0qwmZAETPAVMu', // password321
                'remember_token' => null,
                'account_role' => 0,
                'is_active' => 1,
                'slug' => 'mari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            3 => [
                'id' => 4,
                'name' => 'Manager',
                'email' => 'manager@wharfhq.com',
                'email_verified_at' => null,
                'password' => '$2y$10$n7TDzqV8Auj5A6kg6S2iK.LRCCyNB.anDj0m8EVh0qwmZAETPAVMu', // password321
                'remember_token' => null,
                'account_role' => 0,
                'is_active' => 1,
                'slug' => 'paki',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            4 => [
                'id' => 5,
                'name' => 'Alamin',
                'email' => 'developer@wharfhq.com',
                'email_verified_at' => null,
                'password' => '$2y$10$n7TDzqV8Auj5A6kg6S2iK.LRCCyNB.anDj0m8EVh0qwmZAETPAVMu', // password321
                'remember_token' => null,
                'account_role' => 1,
                'is_active' => 1,
                'slug' => 'alamin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
