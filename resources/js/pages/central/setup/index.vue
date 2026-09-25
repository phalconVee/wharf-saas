<template>
  <div>
    <!-- breadcrumbs Start -->
    <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent" />
    <!-- breadcrumbs end -->
    <div class="col-lg-12">
      <div class="row set-up-page">
        <div v-if="$can('general-settings')" class="col-xxl-3 col-lg-4 col-sm-12 col-md-6
        ">
          <div class="card card-large-icons">
            <div class="card-icon text-white bg-success">
              <i class="fas fa-cog" />
            </div>
            <div class="card-body">
              <h5>{{ $t('central.setup.index.menu.item_one.title') }}</h5>
              <p>
                {{ $t('central.setup.index.menu.item_one.description') }}
              </p>
              <router-link :to="{ name: 'setup.general' }" href="#" class="card-cta">
                {{ $t('central.setup.index.menu.item_one.link_text') }}
                <i class="fas fa-long-arrow-alt-right" />
              </router-link>
            </div>
          </div>
        </div>
        <div v-if="$can('general-settings')" class="col-xxl-3 col-lg-4 col-sm-12 col-md-6
        ">
          <div class="card card-large-icons">
            <div class="card-icon text-white bg-success">
              <i class="fas fa-envelope" />
            </div>
            <div class="card-body">
              <h5>{{ $t('central.setup.index.menu.item_five.title') }}</h5>
              <p>
                {{ $t('central.setup.index.menu.item_five.description') }}
              </p>
              <router-link :to="{ name: 'setup.mailConfiguration' }" href="#" class="card-cta">
                {{ $t('central.setup.index.menu.item_one.link_text') }}
                <i class="fas fa-long-arrow-alt-right" />
              </router-link>
            </div>
          </div>
        </div>
        <div v-if="$can('general-settings')" class="col-xxl-3 col-lg-4 col-sm-12 col-md-6
        ">
          <div class="card card-large-icons">
            <div class="card-icon text-white bg-success">
              <i class="fas fa-sms" />
            </div>
            <div class="card-body">
              <h5>{{ $t('central.setup.index.menu.item_six.title') }}</h5>
              <p>
                {{ $t('central.setup.index.menu.item_six.description') }}
              </p>
              <router-link :to="{ name: 'setup.smsConfiguration' }" href="#" class="card-cta">
                {{ $t('central.setup.index.menu.item_one.link_text') }}
                <i class="fas fa-long-arrow-alt-right" />
              </router-link>
            </div>
          </div>
        </div>
        <div v-if="$can('payment-settings')" class="col-xxl-3 col-lg-4 col-sm-12 col-md-6">
          <div class="card card-large-icons">
            <div class="card-icon text-white bg-success">
              <i class="fas fa-money-check-alt" />

            </div>
            <div class="card-body">
              <h5>{{ $t('central.setup.index.menu.item_two.title') }}</h5>
              <p>
                {{ $t('central.setup.index.menu.item_two.description') }}
              </p>
              <router-link :to="{ name: 'advanced-settings' }" class="card-cta">
                {{ $t('central.setup.index.menu.item_two.link_text') }}
                <i class="fas fa-long-arrow-alt-right" />
              </router-link>
            </div>
          </div>
        </div>
        <div v-if="$can('user-role')" class="col-xxl-3 col-lg-4 col-sm-12 col-md-6">
          <div class="card card-large-icons">
            <div class="card-icon text-white bg-success">
              <i class="fas fa-user-lock" />
            </div>
            <div class="card-body">
              <h5>{{ $t('central.setup.index.menu.item_three.title') }}</h5>
              <p>
                {{ $t('central.setup.index.menu.item_three.description') }}
              </p>
              <router-link :to="{ name: 'roles.index' }" class="card-cta">
                {{ $t('central.setup.index.menu.item_three.link_text') }}
                <i class="fas fa-long-arrow-alt-right" />
              </router-link>
            </div>
          </div>
        </div>
        <div v-if="$can('user-management')" class="col-xxl-3 col-lg-4 col-sm-12 col-md-6">
          <div class="card card-large-icons">
            <div class="card-icon text-white bg-success">
              <i class="fas fa-users-cog" />
            </div>
            <div class="card-body">
              <h5>{{ $t('central.setup.index.menu.item_four.title') }}</h5>
              <p>
                {{ $t('central.setup.index.menu.item_four.description') }}
              </p>
              <router-link :to="{ name: 'user.index' }" class="card-cta">
                {{ $t('central.setup.index.menu.item_four.link_text') }}
                <i class="fas fa-long-arrow-alt-right" />
              </router-link>
            </div>
          </div>
        </div>
        <div v-if="$can('general-settings')" class="col-xxl-3 col-lg-4 col-sm-12 col-md-6
        ">
          <div class="card card-large-icons">
            <div class="card-icon text-white bg-success">
              <i class="fas fa-money-check-alt" />
            </div>
            <div class="card-body">
              <h5>{{ $t('central.setup.index.menu.item_seven.title') }}</h5>
              <p>
                {{ $t('central.setup.index.menu.item_seven.description') }}
              </p>
              <router-link :to="{ name: 'setup.centralCurrency.index' }" class="card-cta">
                {{ $t('central.setup.index.menu.item_seven.link_text') }}
                <i class="fas fa-long-arrow-alt-right" />
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  layout: 'central',
  middleware: ['auth', 'check-permissions'],
  metaInfo() {
    return { title: this.$t('setup.index.page_title') }
  },

  data: () => ({
    breadcrumbsCurrent: 'setup.index.breadcrumbs_current',
    breadcrumbs: [
      {
        name: 'setup.index.breadcrumbs_first',
        url: 'home',
      },
      {
        name: 'setup.index.breadcrumbs_active',
        url: '',
      },
    ],
    developer: '',
  }),
  // Map Getters
  computed: {
    ...mapGetters('auth', ['user']),
  },
  created() {
    this.developer = this.user.roles.includes('developer')
  },
}
</script>
