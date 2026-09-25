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
              {{ $t('central.features.edit.form_title') }}
            </h3>
            <router-link :to="{ name: 'features.index' }" class="btn btn-dark float-right">
              <i class="fas fa-long-arrow-alt-left" /> {{ $t('common.back') }}
            </router-link>
          </div>
          <!-- /.card-header -->

          <!-- form start -->
          <form role="form" enctype="multipart/form-data" @submit.prevent="updatePlan" @keydown="form.onKeydown($event)">
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
import { mapGetters } from 'vuex'

export default {
  layout: 'central',
  middleware: ['auth', 'check-permissions'],
  metaInfo() {
    return { title: this.$t('central.features.edit.page_title') }
  },
  data: () => ({
    breadcrumbsCurrent: 'central.features.edit.breadcrumbs_current',
    breadcrumbs: [
      {
        name: 'central.features.edit.breadcrumbs_first',
        url: 'home',
      },
      {
        name: 'central.features.edit.breadcrumbs_second',
        url: 'features.index',
      },
      {
        name: 'central.features.edit.breadcrumbs_current',
        url: '',
      },
    ],
    url: null,
    form: new Form({
      name: '',
    }),
    plans: [],
  }),
  computed: {
    ...mapGetters('operations', ['items']),
  },
  created() {
    this.getPlan()
  },
  methods: {
    // get plan
    async getPlan() {
      const { data } = await axios.get(
        window.location.origin + '/api/features/' + this.$route.params.id
      )
      this.form.name = data.data.name
    },

    // update plan
    async updatePlan() {
      await this.form
        .patch(
          window.location.origin + '/api/features/' + this.$route.params.id
        )
        .then(() => {
          toast.fire({
            type: 'success',
            title: this.$t('central.features.edit.success_msg'),
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

<style lang="scss" scoped></style>
