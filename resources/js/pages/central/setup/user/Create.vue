<template>
  <div>
    <!-- breadcrumbs Start -->
    <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent" />
    <!-- breadcrumbs end -->
    <div class="row">

      <div class="col-12 col-xl-3">
        <SettingsSidebar />
      </div>
      <div class="col-12 col-xl-9">
        <form @submit.prevent="save" @keydown="form.onKeydown($event)">
          <div class="card">
            <div class="card-header setings-header">
              <div class="col-xl-4 col-4">
                <h3 class="card-title">
                  {{ $t("central.setup.user_management.create.form_title") }}
                </h3>
              </div>
              <div class="col-xl-8 col-8 float-right text-right">
                <router-link :to="{ name: 'user.index' }" class="btn btn-dark float-right">
                  <i class="fas fa-long-arrow-alt-left" />
                  {{ $t("common.back") }}
                </router-link>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="name">{{ $t("common.name") }} <span class="required">*</span></label>
                  <input v-model="form.name" id="name" name="name" type="text" class="form-control"
                    :class="{ 'is-invalid': form.errors.has('name') }" :placeholder="$t('common.name_placeholder')" />
                  <has-error :form="form" field="name" />
                </div>

                <div class="form-group col-md-6">
                  <label for="role">{{ $t("common.role") }} <span class="required">*</span></label>
                  <select id="role" v-model="form.role" class="form-control"
                    :class="{ 'is-invalid': form.errors.has('role') }">
                    <option v-for="(role, i) in roles" :value="role.slug" :key="i">{{ role.name }}</option>
                  </select>
                  <has-error :form="form" field="role" />
                </div>

                <div class="form-group col-md-12">
                  <label for="email">{{ $t("common.email") }} <span class="required">*</span></label>
                  <input v-model="form.email" id="email" name="email" type="email" class="form-control"
                    :class="{ 'is-invalid': form.errors.has('email') }" :placeholder="$t('common.email_placeholder')" />
                  <has-error :form="form" field="email" />
                </div>
                <div class="form-group col-md-6">
                  <label for="password">{{ $t("common.default_password") }}</label>
                  <input v-model="form.password" id="password" name="password" type="password" class="form-control"
                    :class="{ 'is-invalid': form.errors.has('password') }" placeholder="********" />
                  <has-error :form="form" field="password" />

                </div>

                <div class="form-group col-md-6">
                  <label for="cpassword">{{ $t("confirm_password") }} </label>
                  <input v-model="form.password_confirmation" id="cpassword" name="cpassword" type="password"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
                    placeholder="********" />
                  <has-error :form="form" field="password_confirmation" />
                </div>

                <!-- Send Mail If Checked -->
                <div class="col-span-12">
                  <checkbox v-model="form.mail" name="mail" class="custom-control custom-checkbox d-flex ml-2">
                    <span class="text-gray-700 dark:text-gray-200 font-medium capitalize mt-1 inline-block">{{
                      $t("common.welcome_mail")
                    }}</span>
                  </checkbox>
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
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Form from 'vform'
import axios from 'axios'
import SettingsSidebar from '~/components/central/SettingsSidebar'

export default {
  layout: 'central',
  middleware: ['auth', 'check-permissions'],

  metaInfo() {
    return { title: this.$t('central.setup.user_management.create.page_title') }
  },

  components: {
    SettingsSidebar,
  },

  data: () => ({
    breadcrumbsCurrent: 'central.setup.user_management.create.page_title',
    breadcrumbs: [
      {
        name: 'central.setup.user_management.create.breadcrumbs_first',
        url: 'home',
      },
      {
        name: 'central.setup.user_management.create.breadcrumbs_second',
        url: 'setup.index',
      },
      {
        name: 'central.setup.user_management.create.breadcrumbs_third',
        url: 'user.index',
      },
      {
        name: 'central.setup.user_management.create.breadcrumbs_current',
        url: '',
      },
    ],
    roles: [],
    form: new Form({
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      role: 'super-admin',
      mail: true,
    })
  }),

  created() {
    this.getRole();
  },

  methods: {
    async getRole() {
      await axios.get(`/api/get-role`).then((data) => {
        this.roles = data.data;
      })
    },
    async save() {
      await this.form
        .post(window.location.origin + '/api/user')
        .then(() => {
          toast.fire({
            type: 'success',
            title: this.$t('central.setup.user_management.edit.success_msg'),
          })
          this.$router.push({ name: 'user.index' })
        })
        .catch(() => {
          toast.fire({
            type: 'error',
            title: this.$t('common.error'),
          })
        })
    }
  },
}
</script>

<style lang="scss" scoped></style>
