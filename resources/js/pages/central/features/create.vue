<template>
  <div>
    <!-- breadcrumbs Start -->
    <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent" />
    <!-- breadcrumbs end -->
    <div class="row">
      <div class="col-lg-8 m-auto">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              {{ $t('central.features.create.form_title') }}
            </h3>
            <router-link :to="{ name: 'features.index' }" class="btn btn-dark float-right">
              <i class="fas fa-long-arrow-alt-left" /> {{ $t('common.back') }}
            </router-link>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" @submit.prevent="save" @keydown="form.onKeydown($event)">
            <div class="card-body">
              <div class="row">
                <div class="form-group col-md-12">
                  <label for="name">{{ $t('central.features.name') }}
                    <span class="required">*</span></label>
                  <input id="name" v-model="form.name" type="text" class="form-control"
                    :class="{ 'is-invalid': form.errors.has('name') }" name="name"
                    :placeholder="$t('central.features.name_placeholder')" />
                  <has-error :form="form" field="name" />
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
    return { title: this.$t('central.features.create.page_title') }
  },
  data: () => ({
    breadcrumbsCurrent: 'central.features.create.breadcrumbs_current',
    breadcrumbs: [
      {
        name: 'central.features.create.breadcrumbs_first',
        url: 'home',
      },
      {
        name: 'central.features.create.breadcrumbs_second',
        url: 'features.index',
      },
      {
        name: 'central.features.create.breadcrumbs_current',
        url: '',
      },
    ],
    url: null,
    form: new Form({
      name: '',
    }),
  }),
  methods: {
    // save plan
    async save() {
      await this.form
        .post(window.location.origin + '/api/features')
        .then(() => {
          toast.fire({
            type: 'success',
            title: this.$t('central.features.create.success_msg'),
          })
          this.$router.push({ name: 'features.index' })
        })
        .catch(() => {
          toast.fire({
            type: 'error',
            title: this.$t('common.error'),
          })
        })
    },
  },
}
</script>

<style lang="scss" scoped>

</style>
