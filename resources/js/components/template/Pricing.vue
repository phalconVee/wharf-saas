<template>
  <!-- PICING AREA START -->
  <section class="section" id="pricing-area">
    <div class="sec-heading">
      <span v-if="appInfo && appInfo.pricing_plan_section_tagline">{{
        appInfo && appInfo.pricing_plan_section_tagline
      }}</span>
      <h2 v-if="appInfo && appInfo.pricing_plan_section_title">{{ appInfo && appInfo.pricing_plan_section_title }}</h2>
    </div>
    <div class="container">
      <div class="row">
        <div v-for="(plan, i) in appInfo && appInfo.plans" :key="i" class="col-md-4">
          <div class="pricing-single">
            <div class="pricing-head">
              <h2>{{ plan.name }}</h2>
              <p v-if="plan.description">{{ plan.description }}</p>
            </div>
            <div class="price">
              <h4>{{ appInfo.currency.symbol }}{{ plan.amount }}</h4>
              <p>{{ $t('template.whats_included') }}</p>
            </div>
            <div class="price-item">
              <ul>
                <li>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-success" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{ $t('Client limit') }}: {{ plan.limit_clients | limitFormat }}</span>
                </li>
                <li>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-success" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{ $t('Domain limit') }}: {{ plan.limit_domains | limitFormat }}</span>
                </li>
                <li>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-success" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{ $t('Employees limit') }}: {{ plan.limit_employees | limitFormat }}</span>
                </li>
                <li>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-success" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{ $t('Suppliers limit') }}: {{ plan.limit_suppliers | limitFormat }}</span>
                </li>
                <li>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-success" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{ $t('Purchase limit') }}: {{ plan.limit_purchases | limitFormat }}</span>
                </li>
                <li>
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-success" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{ $t('Invoice limit') }}: {{ plan.limit_invoices | limitFormat }}</span>
                </li>

                <li v-for="feature in plan.features" :key="feature.id">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-success" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{ feature.name }}</span>
                </li>

                <li v-for="all_feature in plan.all_features" :key="all_feature.id">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-danger" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{ all_feature.name }}</span>
                </li>
              </ul>
              <router-link :to="{ name: 'register' }" class="nav-link">{{ $t('template.buy_now') }}</router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- SCREENSHOT AREA END -->
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Pricing',

  methods: {
    parseJson(data) {
      return JSON.parse(data)
    }
  },

  // Map Getters
  computed: {
    ...mapGetters('operations', ['appInfo']),
  },
}
</script>
