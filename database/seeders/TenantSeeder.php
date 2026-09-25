<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant1 = Tenant::create([
            'company' => 'Mustard Vision LLC',
            'name' => 'Henry Ugo',
            'domain' => 'mustard',
            'email' => 'ugo@mustardvision.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$n7TDzqV8Auj5A6kg6S2iK.LRCCyNB.anDj0m8EVh0qwmZAETPAVMu', // password321
            'ready' => false,
            // some other stuff, if you need. like cashier trials
            'trial_ends_at' => now()->addDays(1000),
            'trial_ends_email_sent_at' => null,
            'primary_domain_id' => null,
            'fallback_domain_id' => null,
            'is_banned' => false,
        ]);

        $domain = $tenant1->createDomain([
            'domain' => 'mustard',
        ]);

        $tenant1->update([
            'ready' => true,
            'primary_domain_id' => $domain->id,
            'fallback_domain_id' => $domain->id,
        ]);

        $tenant2 = Tenant::create([
            'company' => 'Acme Inc',
            'name' => 'Dustin Mallet',
            'domain' => 'acme',
            'email' => 'dustin@acmeinc.xyz',
            'email_verified_at' => now(),
            'password' => '$2y$10$n7TDzqV8Auj5A6kg6S2iK.LRCCyNB.anDj0m8EVh0qwmZAETPAVMu', // password321
            'ready' => false,
            // some other stuff, if you need. like cashier trials
            'trial_ends_at' => now()->addDays(1000),
            'trial_ends_email_sent_at' => null,
            'primary_domain_id' => null,
            'fallback_domain_id' => null,
            'is_banned' => false,
        ]);

        $domain = $tenant2->createDomain([
            'domain' => 'acme',
        ]);

        $tenant2->update([
            'ready' => true,
            'primary_domain_id' => $domain->id,
            'fallback_domain_id' => $domain->id,
        ]);
    }
}
