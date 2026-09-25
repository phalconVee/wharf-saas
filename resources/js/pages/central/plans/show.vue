<template>
  <div>
    <!-- breadcrumbs Start -->
    <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent" />
    <!-- breadcrumbs end -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              {{ $t("plans.view_title") }}
            </h3>
            <router-link :to="{ name: 'plans.index' }" class="btn btn-dark float-right">
              <i class="fas fa-long-arrow-alt-left" /> {{ $t("common.back") }}
            </router-link>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">{{ $t("plans.name") }}</label>
                <input v-model="plan.name" type="text" class="form-control" disabled />
              </div>

              <div class="form-group col-md-6">
                <label for="name">{{ $t("plans.api_id") }}</label>
                <input v-model="plan.api_id" type="text" class="form-control" disabled />
              </div>

              <div class="form-group col-md-6">
                <label for="name">{{ $t("plans.amount") }}</label>
                <input v-model="plan.amount" type="text" class="form-control" disabled />
              </div>

              <div class="form-group col-md-6">
                <label for="name">{{ $t("plans.currency") }}</label>
                <input v-model="plan.currency" type="text" class="form-control" disabled />
              </div>

              <div class="form-group col-md-6">
                <label for="name">{{ $t("plans.interval") }}</label>
                <input v-model="plan.interval" type="text" class="form-control" disabled />
              </div>

              <div class="form-group col-md-6">
                <label for="name">{{ $t("plans.product_id") }}</label>
                <input v-model="plan.product_id" type="text" class="form-control" disabled />
              </div>

              <div class="form-group col-md-6">
                <label for="name">{{ $t("plans.description") }}</label>
                <input v-model="plan.description" type="text" class="form-control" disabled />
              </div>

              <div class="form-group col-md-6">
                <label for="name">{{ $t("plans.created_at") }}</label>
                <input v-model="plan.created_at" type="text" class="form-control" disabled />
              </div>

              <div class="form-group col-md-6">
                <label for="name">{{ $t("plans.updated_at") }}</label>
                <input v-model="plan.updated_at" type="text" class="form-control" disabled />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  layout: "central",
  middleware: ["auth", "check-permissions"],
  metaInfo() {
    return { title: this.$t("setup.plans.view.page_title") };
  },
  data: () => ({
    breadcrumbsCurrent: "setup.plans.view.breadcrumbs_current",
    breadcrumbs: [
      {
        name: "setup.plans.view.breadcrumbs_first",
        url: "home",
      },
      {
        name: "setup.plans.view.breadcrumbs_second",
        url: "setup.index",
      },
      {
        name: "setup.plans.view.breadcrumbs_third",
        url: "plans.index",
      },
      {
        name: "setup.plans.view.breadcrumbs_active",
        url: "",
      },
    ],
    url: null,
    showModal: false,
    plan: {},
  }),
  created() {
    this.getPlan();
  },
  methods: {
    // get the brand
    async getPlan() {
      const { data } = await axios.get(
        window.location.origin + "/api/plans/" + this.$route.params.id
      );
      this.plan = data.data;
    },

    // print
    printWindow() {
      window.print();
    },
  },
};
</script>

<style lang="scss" scoped>

</style>
