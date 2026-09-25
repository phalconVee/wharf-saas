<template>
  <div class="card settings-card no-print">
    <div class="card-header">{{ $t("common.settings") }}</div>
    <div class="card-body">
      <ul class="nav flex-column nav-pills m-1">
        <li v-if="$can('general-settings')" class="nav-item">
          <router-link :to="{ name: 'setup.general' }" class="nav-link thumb">
            <i class="fas fa-cog" />
            {{ $t('central.setup.index.menu.item_one.title') }}
          </router-link>
        </li>
        <li v-if="$can('general-settings')" class="nav-item">
          <router-link :to="{ name: 'setup.mailConfiguration' }" class="nav-link thumb">
            <i class="fas fa-envelope" />
            {{ $t('central.setup.index.menu.item_five.title') }}
          </router-link>
        </li>
        <li v-if="$can('general-settings')" class="nav-item">
          <router-link :to="{ name: 'setup.smsConfiguration' }" class="nav-link thumb">
            <i class="fas fa-sms" />
            {{ $t('central.setup.index.menu.item_six.title') }}
          </router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'setup.centralCurrency.index' }" class="nav-link thumb">
            <i class="fas fa-money-check-alt" />
            {{ $t("central.settings_sidebar_currency") }}
          </router-link>
        </li>
        <li v-if="$can('payment-settings')" class="nav-item">
          <router-link :to="{ name: 'advanced-settings' }" class="nav-link thumb">
            <i class="fas fa-wallet" />
            {{ $t('central.setup.index.menu.item_two.title') }}
          </router-link>
        </li>
        <li v-if="$can('user-role')" class="nav-item">
          <router-link :to="{ name: 'roles.index' }" class="nav-link thumb">
            <i class="fas fa-user-lock" />
            {{ $t('central.setup.index.menu.item_three.title') }}
          </router-link>
        </li>

        <li v-if="$can('user-management')" class="nav-item">
          <router-link :to="{ name: 'user.index' }" class="nav-link thumb">
            <i class="fas fa-user-cog" />
            {{ $t('central.setup.index.menu.item_four.title') }}
          </router-link>
        </li>

      </ul>
    </div>
  </div>
</template>


<script>
import { mapGetters } from "vuex";
export default {
  name: "SettingsSidebar",
  data: () => ({
    developer: "",
  }),
  // Map Getters
  computed: {
    ...mapGetters("auth", ["user"]),
  },
  created() {
    this.developer = this.user.roles.includes("developer");
  },
  methods: {},
};
</script>
