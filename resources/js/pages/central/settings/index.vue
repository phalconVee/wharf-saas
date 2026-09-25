<template>
  <div>
    <!-- breadcrumbs Start -->
    <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent" />
    <!-- breadcrumbs end -->

    <div class="row">
      <div class="col-sm-12 col-md-4 col-lg-3 col-xl-2">
        <card :title="$t('settings.name')" class="settings-card">
          <ul class="nav flex-column nav-pills m-1">
            <li v-for="tab in tabs" :key="tab.route" class="nav-item">
              <router-link :to="{ name: tab.route }" class="nav-link thumb" active-class="active">
                <fa :icon="tab.icon" fixed-width />
                {{ tab.name }}
              </router-link>
            </li>
          </ul>
        </card>
      </div>
      <div class="col-sm-12 col-md-8 col-lg-9 col-xl-10">
        <transition name="fade" mode="out-in">
          <router-view />
        </transition>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  layout: 'central',
  middleware: 'auth',

  metaInfo() {
    return { title: this.$t('settings.page_title') }
  },

  data: () => ({
    breadcrumbsCurrent: 'settings.breadcrumbs_current',
    breadcrumbs: [
      {
        name: 'settings.breadcrumbs_first',
        url: 'home',
      },
      {
        name: 'settings.breadcrumbs_active',
        url: '',
      },
    ]
  }),

  computed: {
    tabs() {
      return [
        {
          icon: 'mask',
          name: this.$t('common.hero'),
          route: 'settings.hero',
        },
        {
          icon: 'address-card',
          name: this.$t('common.about_us'),
          route: 'settings.about-us',
        },
        {
          icon: 'question',
          name: this.$t('common.why-us'),
          route: 'settings.why-us',
        },
        {
          icon: 'briefcase',
          name: this.$t('common.business-start'),
          route: 'settings.business-start',
        },
        {
          icon: 'asterisk',
          name: this.$t('common.features'),
          route: 'settings.features',
        },
        {
          icon: 'bolt',
          name: 'Explorers',
          route: 'settings.explorers',
        },
        {
          icon: 'hourglass-start',
          name: 'All features',
          route: 'settings.all-features',
        },
        {
          icon: 'space-shuttle',
          name: 'CTA Area',
          route: 'settings.cta',
        },
        {
          icon: 'eye',
          name: 'Software overview',
          route: 'settings.software-overview',
        },
        {
          icon: 'money-bill',
          name: 'Pricing plan',
          route: 'settings.pricing-plan',
        },
        {
          icon: 'star',
          name: 'Testimonial',
          route: 'settings.testimonial',
        },
        {
          icon: 'newspaper',
          name: 'Brands',
          route: 'settings.brands',
        },
        {
          icon: 'envelope',
          name: 'Newsletter',
          route: 'settings.newsletter',
        },
        {
          icon: 'code',
          name: 'Custom HTML',
          route: 'settings.custom-html',
        },
      ]
    }
  }
}
</script>

<style>
.settings-card .card-header {
  border-bottom: 1px solid#ddd;
  box-shadow: none;
}

.settings-card .card-body {
  padding: 10px;
}

.settings-card .nav-pills .nav-link,
.settings-card .nav-tabs .nav-link {
  justify-content: flex-start;
}

.settings-card .nav-pills .nav-link.active,
.settings-card .nav-pills .show>.nav-link {
  color: #FF6813;
  background-color: #FFB380;
}

.settings-card {
  position: sticky;
  top: 30px;
}
</style>
