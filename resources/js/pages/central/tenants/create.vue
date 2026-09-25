<template>
  <div>
    <!-- breadcrumbs Start -->
    <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent" />
    <!-- breadcrumbs end -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ $t('central.tenants.create.form_title') }}</h3>
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
                  <label for="company">{{
                  $t('common.company')
                  }}</label>
                  <input id="company" v-model="form.company" type="text" class="form-control"
                    :class="{ 'is-invalid': form.errors.has('company') }" name="company"
                    :placeholder="$t('common.company_placeholder')" />
                  <has-error :form="form" field="company" />
                </div>
                <div class="form-group col-md-6">
                  <label for="name">{{ $t('common.name') }}
                    <span class="required">*</span></label>
                  <input id="name" v-model="form.name" type="text" class="form-control"
                    :class="{ 'is-invalid': form.errors.has('name') }" name="name"
                    :placeholder="$t('common.name_placeholder')" />
                  <has-error :form="form" field="name" />
                </div>
                <div class="form-group col-md-6">
                  <label for="domain">{{ $t('common.domain') }}
                    <span class="required">*</span></label>
                  <input id="domain" v-model="form.domain" type="text" class="form-control"
                    :class="{ 'is-invalid': form.errors.has('domain') }" name="domain"
                    :placeholder="$t('common.domain_placeholder')" />
                  <has-error :form="form" field="domain" />
                </div>
                <div class="form-group col-md-6">
                  <label for="email">{{ $t('common.email') }}</label>
                  <input id="email" v-model="form.email" type="email" class="form-control"
                    :class="{ 'is-invalid': form.errors.has('email') }" name="email"
                    :placeholder="$t('common.email_placeholder')" />
                  <has-error :form="form" field="email" />
                </div>
                <div class="form-group col-md-6">
                  <label for="password">{{ $t('common.password') }}</label>
                  <input id="password" v-model="form.password" type="password" class="form-control"
                    :class="{ 'is-invalid': form.errors.has('password') }" name="password"
                    :placeholder="$t('common.password_placeholder')" />
                  <has-error :form="form" field="password" />
                </div>
                <div class="form-group col-md-6">
                  <label for="password_confirmation">{{ $t('common.password_confirmation') }}</label>
                  <input id="password_confirmation" v-model="form.password_confirmation" type="password"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
                    name="password_confirmation" :placeholder="$t('common.password_confirmation_placeholder')" />
                  <has-error :form="form" field="password_confirmation" />
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <v-button :loading="form.busy" class="btn btn-primary">
                <i class="fas fa-save" /> {{ $t('common.save') }}
              </v-button>
              <button type="reset" class="btn btn-secondary float-right" @click="form.reset()">
                <i class="fas fa-power-off" /> {{ $t('common.reset') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  layout: 'central',
  middleware: ['auth', 'check-permissions'],
  metaInfo() {
    return { title: this.$t('central.tenants.create.page_title') }
  },
  data: () => ({
    breadcrumbsCurrent: 'central.tenants.create.breadcrumbs_current',
    breadcrumbs: [
      {
        name: 'central.tenants.create.breadcrumbs_first',
        url: 'home',
      },
      {
        name: 'central.tenants.create.breadcrumbs_second',
        url: 'tenants.index',
      },
      {
        name: 'central.tenants.create.breadcrumbs_active',
        url: '',
      },
    ],
    form: new Form({
      company: '',
      name: '',
      domain: '',
      email: '',
      password: '',
      status: 1,
    }),
    loading: true,
    url: null,
  }),
  methods: {
    // save
    async save() {
      await this.form
        .post(window.location.origin + '/api/tenants')
        .then(() => {
          toast.fire({
            type: 'success',
            title: this.$t('tenants.create.success_msg'),
          })
          this.$router.push({ name: 'tenants.index' })
        })
        .catch((e) => {
          if (e.response.status === 403) {
            this.$store.dispatch('operations/setSubscriptionLimitMessage', e.response.data.message)
          }

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
