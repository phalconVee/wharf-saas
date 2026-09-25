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
              {{ $t('central.pages.create.form_title') }}
            </h3>
            <router-link :to="{ name: 'pages.index' }" class="btn btn-dark float-right">
              <i class="fas fa-long-arrow-alt-left" /> {{ $t('common.back') }}
            </router-link>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" enctype="multipart/form-data" @submit.prevent="save" @keydown="form.onKeydown($event)">
            <div class="card-body">
              <div class="row">
                <div class="form-group col-md-12">
                  <label for="name">{{ $t('central.pages.name') }}
                    <span class="required">*</span></label>
                  <input id="name" v-model="form.name" type="text" class="form-control"
                    :class="{ 'is-invalid': form.errors.has('name') }" name="name"
                    :placeholder="$t('central.pages.name_placeholder')" />
                  <has-error :form="form" field="name" />
                </div>

                <div class="form-group col-md-12">
                  <label for="status">{{ $t('common.type') }}</label>
                  <select id="type" v-model="form.type" class="form-control"
                    :class="{ 'is-invalid': form.errors.has('type') }">
                    <option value="0">{{ $t('central.pages.information') }}</option>
                    <option value="1">{{ $t('central.pages.need_help') }}</option>
                  </select>
                  <has-error :form="form" field="type" />
                </div>

                <div class="form-group col-md-12">
                  <label for="status">{{ $t('common.status') }}</label>
                  <select id="status" v-model="form.status" class="form-control"
                    :class="{ 'is-invalid': form.errors.has('status') }">
                    <option value="1">{{ $t('common.active') }}</option>
                    <option value="0">{{ $t('common.in_active') }}</option>
                  </select>
                  <has-error :form="form" field="status" />
                </div>

                <div class="form-group col-md-12">
                  <label for="body">{{ $t('central.pages.content') }}<span class="required">*</span></label>
                  <Editor ref="toastuiEditor" :initialValue="form.content" id="content" name="content"
                    class="form-control" :class="{ 'is-invalid': form.errors.has('content') }" height="500px"
                    initialEditType="markdown" @change="updateContent" />
                  <has-error :form="form" field="content" />
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
import '@toast-ui/editor/dist/toastui-editor.css'
import { Editor } from '@toast-ui/vue-editor'

export default {
  layout: 'central',
  middleware: ['auth', 'check-permissions'],
  metaInfo() {
    return { title: this.$t('central.pages.create.page_title') }
  },
  components: {
    Editor
  },
  data: () => ({
    breadcrumbsCurrent: 'central.pages.create.breadcrumbs_current',
    breadcrumbs: [
      {
        name: 'central.pages.create.breadcrumbs_first',
        url: 'home',
      },
      {
        name: 'central.pages.create.breadcrumbs_second',
        url: 'pages.index',
      },
      {
        name: 'central.pages.create.breadcrumbs_active',
        url: '',
      },
    ],
    url: null,
    form: new Form({
      name: '',
      type: 0,
      content: '',
      status: 1,
    }),
  }),
  methods: {
    updateContent() {
      this.form.content = this.$refs.toastuiEditor.invoke('getHTML')
    },
    // save
    async save() {
      await this.form
        .post(window.location.origin + '/api/pages')
        .then(() => {
          toast.fire({
            type: 'success',
            title: this.$t('central.pages.create.success_msg'),
          })
          this.$router.push({ name: 'pages.index' })
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
