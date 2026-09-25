<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;

class InitializeTenancyByDomainOrTenantSubdomain extends InitializeTenancyByDomain
{
    public function handle($request, Closure $next)
    {
        $hostname = $request->getHost();
        $tenantBaseDomain = config('tenancy.tenant_base_domain');
        $suffix = '.'.$tenantBaseDomain;

        if (Str::endsWith($hostname, $suffix)) {
            $subdomain = Str::beforeLast($hostname, $suffix);

            if (! str_contains($subdomain, '.')) {
                return $this->initializeTenancy($request, $next, $subdomain);
            }
        }

        return $this->initializeTenancy($request, $next, $hostname);
    }
}
