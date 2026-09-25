<template>
    <div>
        <!--- SECTION TITLE FORM START --->
        <div class="card">
            <div class="card-header setings-header">
                <h3 class="card-title">{{ $t('common.software_overview') }}</h3>
            </div>
            <form
                class="form-horizontal"
                @submit.prevent="update"
                @keydown="form.onKeydown($event)"
            >
                <div class="card-body">
                    <div class="form-group">
                        <label for="software_overview_section_tagline">
                            {{
                                $t('common.software_overview_section_tagline')
                            }}
                            <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            v-model="form.software_overview_section_tagline"
                            class="form-control"
                            :class="{
                                'is-invalid': form.errors.has(
                                    'software_overview_section_tagline'
                                ),
                            }"
                            id="software_overview_section_tagline"
                            :placeholder="
                                $t(
                                    'common.software_overview_section_tagline_placeholder'
                                )
                            "
                        />
                        <has-error
                            :form="form"
                            field="software_overview_section_tagline"
                        />
                    </div>
                    <div class="form-group">
                        <label for="software_overview_section_title">
                            {{ $t('common.software_overview_section_title') }}
                            <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            v-model="form.software_overview_section_title"
                            class="form-control"
                            :class="{
                                'is-invalid': form.errors.has(
                                    'software_overview_section_title'
                                ),
                            }"
                            id="software_overview_section_title"
                            :placeholder="
                                $t(
                                    'common.software_overview_section_title_placeholder'
                                )
                            "
                        />
                        <has-error
                            :form="form"
                            field="software_overview_section_title"
                        />
                    </div>
                </div>
                <div class="card-footer">
                    <v-button :loading="form.busy" class="btn btn-primary">
                        <i class="fas fa-edit" />
                        {{ $t('common.save_changes') }}
                    </v-button>
                </div>
            </form>
        </div>
        <!--- SECTION TITLE FORM END --->

        <!--- SECTION DATA TABLE START --->
        <div class="row mt-5 mb-4">
            <div class="col-lg-12">
                <div class="card custom-card w-100">
                    <div class="card-header setings-header">
                        <div class="col-xl-4 col-4">
                            <h3 class="card-title">
                                {{ $t('Software Overview Elements') }}
                            </h3>
                        </div>
                        <div class="col-xl-8 col-8 float-right text-right">
                            <div class="btn-group c-w-100">
                                <a
                                    @click="refreshTable()"
                                    href="#"
                                    v-tooltip="'Refresh'"
                                    class="btn btn-success"
                                >
                                    <i class="fas fa-sync"></i>
                                </a>
                                <button
                                    @click="showModal = !showModal"
                                    class="btn btn-primary"
                                >
                                    {{ $t('common.create') }}
                                    <i
                                        class="fas fa-plus-circle d-none d-sm-inline-block"
                                    />
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body position-relative">
                        <div class="row">
                            <div class="col-6 col-xl-4 mb-2">
                                <search
                                    v-model="query"
                                    @reset-pagination="resetPagination()"
                                    @reload="reload"
                                />
                            </div>
                        </div>
                        <table-loading v-show="loading" />
                        <div
                            id="printMe"
                            class="table-responsive table-custom mt-3"
                        >
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ $t('common.s_no') }}</th>
                                        <th>
                                            {{
                                                $t(
                                                    'central.setting_images.image'
                                                )
                                            }}
                                        </th>
                                        <th>{{ $t('common.status') }}</th>
                                        <th class="text-right no-print">
                                            {{ $t('common.action') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-show="items.length"
                                        v-for="(data, i) in items"
                                        :key="i"
                                    >
                                        <td>
                                            <span
                                                v-if="
                                                    pagination &&
                                                    pagination.current_page > 1
                                                "
                                            >
                                                {{
                                                    pagination.per_page *
                                                        (pagination.current_page -
                                                            1) +
                                                    (i + 1)
                                                }}
                                            </span>
                                            <span v-else>{{ i + 1 }}</span>
                                        </td>
                                        <td>
                                            <div v-if="data.image">
                                                <img
                                                    :src="data.image"
                                                    class="rounded preview-sm"
                                                    loading="lazy"
                                                />
                                            </div>
                                            <div
                                                v-else
                                                class="bg-secondary rounded no-preview-sm"
                                            >
                                                <small>{{
                                                    $t('common.no_preview')
                                                }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                v-if="data.status === 1"
                                                class="badge bg-success"
                                                >{{ $t('common.active') }}</span
                                            >
                                            <span
                                                v-else
                                                class="badge bg-danger"
                                                >{{
                                                    $t('common.in_active')
                                                }}</span
                                            >
                                        </td>
                                        <td class="text-right no-print">
                                            <div class="btn-group">
                                                <a
                                                    href="#"
                                                    v-tooltip="
                                                        $t('common.edit')
                                                    "
                                                    @click="editData(data.id)"
                                                    class="btn btn-info btn-sm"
                                                >
                                                    <i class="fas fa-edit" />
                                                </a>
                                                <a
                                                    v-tooltip="
                                                        $t('common.delete')
                                                    "
                                                    href="#"
                                                    class="btn btn-danger btn-sm"
                                                    @click="deleteData(data.id)"
                                                >
                                                    <i class="fas fa-trash" />
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-show="!loading && !items.length">
                                        <td colspan="6">
                                            <EmptyTable />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="dtable-footer">
                            <div class="form-group row display-per-page">
                                <label>{{ $t('per_page') }} </label>
                                <div>
                                    <select
                                        @change="updatePerPager"
                                        v-model="perPage"
                                        class="form-control form-control-sm ml-1"
                                    >
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                            <!-- pagination-start -->
                            <pagination
                                v-if="pagination && pagination.last_page > 1"
                                :pagination="pagination"
                                :offset="5"
                                class="justify-flex-end"
                                @paginate="paginate"
                            />
                            <!-- pagination-end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--- SECTION DATA TABLE START --->

        <!-- use the modal component -->
        <Modal v-if="showModal" @close="closeModal">
            <h5 slot="header">{{ $t('common.software_overview') }}</h5>
            <div class="w-100 m-0" slot="body">
                <form
                    ref="form"
                    @submit.prevent="save"
                    @keydown="dataForm.onKeydown($event)"
                    class="row"
                >
                    <!-- image -->
                    <div class="form-group col-md-12">
                        <label for="image">
                            {{ $t('central.setting_images.image') }}
                            <span class="required">*</span>
                        </label>
                        <div class="custom-file">
                            <input
                                id="image"
                                type="file"
                                class="custom-file-input"
                                name="image"
                                :class="{
                                    'is-invalid': dataForm.errors.has('image'),
                                }"
                                @change="onFileChange"
                            />
                            <label class="custom-file-label" for="image">{{
                                $t('common.choose_file')
                            }}</label>
                        </div>
                        <has-error :form="dataForm" field="image" />
                        <div v-if="url" class="bg-light mt-4 w-25">
                            <img
                                class="img-fluid"
                                :alt="$t('common.image_alt')"
                                :src="url"
                            />
                        </div>
                    </div>

                    <!-- status -->
                    <div class="form-group col-md-12">
                        <label for="status">
                            {{ $t('common.status') }}
                            <span class="required">*</span>
                        </label>
                        <select
                            id="status"
                            v-model="dataForm.status"
                            class="form-control"
                            name="status"
                            :class="{
                                'is-invalid': dataForm.errors.has('status'),
                            }"
                        >
                            <option value="1">{{ $t('common.active') }}</option>
                            <option value="0">
                                {{ $t('common.in_active') }}
                            </option>
                        </select>
                        <has-error :form="dataForm" field="status" />
                    </div>
                </form>
            </div>
            <div
                slot="modal-footer"
                class="d-flex w-100 justify-content-between p-3"
            >
                <button
                    @click="handleFormSubmit"
                    type="submit"
                    class="btn btn-primary"
                >
                    <i class="fas fa-edit"></i> {{ $t('common.save_changes') }}
                </button>
                <button
                    type="button"
                    class="btn btn-danger"
                    @click="closeModal"
                >
                    {{ $t('Close') }}
                </button>
            </div>
        </Modal>
    </div>
</template>

<script>
import Form from 'vform';
import axios from 'axios';
import { mapGetters } from 'vuex';

export default {
    layout: 'central',
    middleware: ['auth', 'check-permissions'],
    metaInfo() {
        return { title: this.$t('settings.page_title') };
    },
    data: () => ({
        breadcrumbsCurrent: 'user_profile.breadcrumbs_current',
        breadcrumbs: [
            {
                name: 'user_profile.breadcrumbs_first',
                url: 'home',
            },
            {
                name: 'user_profile.breadcrumbs_active',
                url: '',
            },
        ],
        form: new Form({
            software_overview_section_tagline: '',
            software_overview_section_title: '',
        }),
        dataForm: new Form({
            status: 1,
            image: null,
            type: 'software_overview_images',
        }),
        showModal: false,
        query: '',
        perPage: 10,
        url: null,
        typeName: 'type',
        typeValue: 'software_overview_images',
        formType: 'create', // create or edit
        formUpdateId: null,
        isDemoMode: window.config.isDemoMode,
    }),

    // Map Getters
    computed: {
        ...mapGetters('operations', ['items', 'loading', 'pagination']),
    },

    created() {
        this.getData();
        this.getTableData();
    },

    watch: {
        // watch search data
        query: function (newQ) {
            if (newQ === '') {
                this.getSoftwareOverviewData();
            } else {
                this.searchData();
            }
        },
    },

    methods: {
        // get the data
        async getData() {
            const { data } = await axios.get(
                window.location.origin +
                    '/api/settings/software-overview-settings'
            );
            this.user = data.data;
            this.form.fill(data.data);
        },

        // update the data
        async update() {
            // disable for demo
            if (this.isDemoMode) {
                return toast.fire({
                    type: 'warning',
                    title: this.$t(
                        'You are not allowed to do this in demo version.'
                    ),
                });
            }
            await this.form
                .patch(
                    window.location.origin +
                        '/api/settings/software-overview-settings'
                )
                .then(() => {
                    toast.fire({
                        type: 'success',
                        title: this.$t('settings.success_msg'),
                    });
                })
                .catch(() => {
                    toast.fire({
                        type: 'error',
                        title: this.$t('common.error_msg'),
                    });
                });
        },

        /***************************************
         * --- new modal and table starts -----
         **************************************/
        clearEverythingReloadDataHideModalAfterSubmit() {
            this.formType = 'create'; // create or edit
            this.formUpdateId = null;
            this.showModal = false;
            this.dataForm.image = null;
            this.dataForm.reset();
            this.dataForm.clear();
            this.url = null;
        },

        // handle form submit
        handleFormSubmit() {
            if (this.formType === 'create') {
                this.createData();
            } else {
                this.updateData(this.formUpdateId);
            }
        },

        // create
        createData() {
            // disable for demo
            if (this.isDemoMode) {
                return toast.fire({
                    type: 'warning',
                    title: this.$t(
                        'You are not allowed to do this in demo version.'
                    ),
                });
            }
            this.dataForm
                .post('/api/setting-images')
                .then(() => {
                    toast.fire({
                        type: 'success',
                        title: this.$t('common.success_msg'),
                    });
                    this.getTableData();
                    this.clearEverythingReloadDataHideModalAfterSubmit();
                })
                .catch(() => {
                    toast.fire({
                        type: 'error',
                        title: this.$t('common.error_msg'),
                    });
                });
        },

        // update
        async updateData(id) {
            // disable for demo
            if (this.isDemoMode) {
                return toast.fire({
                    type: 'warning',
                    title: this.$t(
                        'You are not allowed to do this in demo version.'
                    ),
                });
            }
            this.dataForm._method = 'PATCH';
            await this.dataForm
                .post('/api/setting-images/' + id)
                .then(() => {
                    toast.fire({
                        type: 'success',
                        title: this.$t('central.pages.edit.success_msg'),
                    });
                    this.getTableData();
                    this.clearEverythingReloadDataHideModalAfterSubmit();
                })
                .catch(() => {
                    toast.fire({
                        type: 'error',
                        title: this.$t('common.error'),
                    });
                });
        },

        // vue file upload
        onFileChange(e) {
            const file = e.target.files[0];
            const reader = new FileReader();
            if (
                file.size < 2111775 &&
                (file.type === 'image/jpeg' ||
                    file.type === 'image/png' ||
                    file.type === 'image/gif')
            ) {
                this.dataForm.image = file;
                reader.readAsDataURL(file);
                this.url = URL.createObjectURL(file);
            } else {
                toast.fire(
                    this.$t('common.error'),
                    this.$t('common.image_error'),
                    'error'
                );
            }
        },

        // get data
        async getTableData() {
            this.$store.state.operations.loading = true;
            let currentPage = this.pagination
                ? this.pagination.current_page
                : 1;
            await this.$store.dispatch('operations/fetchDataByType', {
                path: '/api/setting-images?page=',
                currentPage: currentPage + '&perPage=' + this.perPage,
                typeName: this.typeName,
                typeValue: this.typeValue,
            });
        },

        // update per page count
        updatePerPager() {
            this.pagination.current_page = 1;
            this.query === '' ? this.getTableData() : this.searchData();
        },

        // search data
        async searchData() {
            this.$store.state.operations.loading = true;
            let currentPage = this.pagination
                ? this.pagination.current_page
                : 1;
            await this.$store.dispatch('operations/searchDataByType', {
                term: this.query,
                path: '/api/setting-images/search',
                currentPage: currentPage + '&perPage=' + this.perPage,
                typeName: this.typeName,
                typeValue: this.typeValue,
            });
        },

        // Pagination
        async paginate() {
            this.query === ''
                ? await this.getTableData()
                : await this.searchData();
        },

        // Reset pagination
        async resetPagination() {
            this.pagination.current_page = 1;
        },

        // Reload after search
        async reload() {
            this.query = '';
        },

        // refresh table
        refreshTable() {
            this.query = '';
            this.query === '' ? this.getTableData() : this.searchData();
        },

        closeModal() {
            this.clearEverythingReloadDataHideModalAfterSubmit();
        },

        // save
        async save() {
            this.handleFormSubmit();
        },

        // edit data
        async editData(id) {
            // disable for demo
            if (this.isDemoMode) {
                return toast.fire({
                    type: 'warning',
                    title: this.$t(
                        'You are not allowed to do this in demo version.'
                    ),
                });
            }
            this.formType = 'edit';
            this.formUpdateId = id;
            const { data } = await axios.get(
                window.location.origin + '/api/setting-images/' + id
            );
            this.dataForm.fill(data.data);
            this.url = data.data.image;
            this.showModal = true;
        },

        // delete data
        async deleteData(id) {
            // disable for demo
            if (this.isDemoMode) {
                return toast.fire({
                    type: 'warning',
                    title: this.$t(
                        'You are not allowed to do this in demo version.'
                    ),
                });
            }
            Swal.fire({
                title: this.$t('common.delete_title'),
                text: this.$t('common.delete_warning'),
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: this.$t(
                    'central.setting_images.index.delete_confirm_button'
                ),
            }).then((result) => {
                // Send request to the server
                if (result.value) {
                    this.$store
                        .dispatch('operations/deleteData', {
                            path: '/api/setting-images/',
                            slug: id,
                        })
                        .then((response) => {
                            if (response === true) {
                                Swal.fire(
                                    this.$t('common.deleted'),
                                    this.$t('common.delete_success'),
                                    'success'
                                );
                                this.getTableData();
                            } else {
                                Swal.fire(
                                    this.$t('common.failed'),
                                    this.$t('common.delete_failed'),
                                    'warning'
                                );
                            }
                        });
                }
            });
        },
    },
};
</script>

<style lang="scss" scoped></style>
