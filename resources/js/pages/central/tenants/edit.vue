<template>
  <div>
    <!-- breadcrumbs Start -->
    <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent" />
    <!-- breadcrumbs end -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ $t('central.tenants.edit.form_title') }}</h3>
            <router-link :to="{ name: 'tenants.index' }" class="btn btn-dark float-right">
              <i class="fas fa-long-arrow-alt-left" /> {{ $t('common.back') }}
            </router-link>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" @submit.prevent="save" @keydown="form.onKeydown($event)">
            <div class="card-body">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">
                    {{ $t('common.name') }}
                    <span class="required">*</span>
                  </label>
                  <input id="name" v-model="form.name" type="text" class="form-control"
                    :class="{ 'is-invalid': form.errors.has('name') }" name="name"
                    :placeholder="$t('common.name_placeholder')" />
                  <has-error :form="form" field="name" />
                </div>

                <div class="form-group col-md-6">
                  <label for="email">{{ $t('common.company') }}</label>
                  <input id="company" v-model="form.company" type="text" class="form-control"
                    :class="{ 'is-invalid': form.errors.has('company') }" name="company"
                    :placeholder="$t('common.company_placeholder')" />
                  <has-error :form="form" field="company" />
                </div>

                <!-- <div class="form-group col-md-6">
                  <label for="plan_id">
                    {{ $t('common.plan') }}
                  </label>
                  <v-select
                    v-model="form.plan_id"
                    :options="plans"
                    :reduce="plan => plan.id"
                    :label="$t('name')"
                    :class="{ 'is-invalid': form.errors.has('plan_id') }"
                    id="plan_id"
                    :placeholder="$t('common.plan_placeholder')">
                  </v-select>
                  <has-error :form="form" field="plan_id"/>
                </div> -->

                <!--
                <div v-if="form.plan_id" class="form-group col-md-6">
                  <label for="subscription_status">
                    {{ $t('common.status') }}
                    <span class="required">*</span>
                  </label>
                  <select
                    id="subscription_status"
                    v-model="form.subscription_status"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('subscription_status') }"
                    :required="form.plan_id"
                  >
                    <option :value="null">{{ $t('Select a status') }}</option>
                    <option value="1" :selected="form.plan_id == 1">{{ $t('common.active') }}</option>
                    <option value="0" :selected="form.plan_id == 0">{{ $t('common.in_active') }}</option>
                  </select>
                  <has-error :form="form" field="subscription_status"/>
                </div>
                -->
              </div>
            </div>

            <!-- /.card-body -->
            <div class="card-footer">
              <v-button :loading="form.busy" class="btn btn-primary">
                <i class="fas fa-edit" /> {{ $t('common.save_changes') }}
              </v-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import axios from 'axios'

export default {
  layout: 'central',
  middleware: ['auth', 'check-permissions'],
  metaInfo() {
    return { title: this.$t('central.tenants.edit.page_title') }
  },
  data: () => ({
    breadcrumbsCurrent: 'central.tenants.edit.breadcrumbs_current',
    breadcrumbs: [
      {
        name: 'central.tenants.edit.breadcrumbs_first',
        url: 'home',
      },
      {
        name: 'central.tenants.edit.breadcrumbs_second',
        url: 'tenants.index',
      },
      {
        name: 'central.tenants.edit.breadcrumbs_active',
        url: '',
      },
    ],
    form: new Form({
      name: '',
      company: '',
    }),
    loading: true,
    url: null,
    plans: [],
  }),
  created() {
    this.getPlans()
    this.getTenant()
  },
  methods: {
    // get the tenant
    async getTenant() {
      const { data } = await axios.get(
        window.location.origin + '/api/tenants/' + this.$route.params.id
      )
      this.form.fill(data)
    },

    async getPlans() {
      const { data } = await axios.get(
        window.location.origin + "/api/plans"
      );
      this.plans = data.data
    },

    // update client
    async save() {
      await this.form
        .patch(
          window.location.origin + '/api/tenants/' + this.$route.params.id
        )
        .then(() => {
          toast.fire({
            type: 'success',
            title: this.$t('tenants.edit.success_msg'),
          })
          this.$router.push({ name: 'tenants.index' })
        })
        .catch(() => {
          toast.fire({
            type: 'error',
            title: this.$t('common.error_msg'),
          })
        })
    },
  },
}
</script>

<style lang="scss" scoped>

</style>
