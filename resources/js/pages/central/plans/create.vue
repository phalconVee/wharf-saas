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
                            {{ $t('central.plans.create.form_title') }}
                        </h3>
                        <router-link
                            :to="{ name: 'plans.index' }"
                            class="btn btn-dark float-right"
                        >
                            <i class="fas fa-long-arrow-alt-left" />
                            {{ $t('common.back') }}
                        </router-link>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form
                        role="form"
                        enctype="multipart/form-data"
                        @submit.prevent="savePlan"
                        @keydown="form.onKeydown($event)"
                    >
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">
                                        {{ $t('central.plans.name') }}
                                        <span class="required">*</span>
                                    </label>
                                    <input
                                        id="name"
                                        v-model="form.name"
                                        type="text"
                                        class="form-control"
                                        :class="{
                                            'is-invalid':
                                                form.errors.has('name'),
                                        }"
                                        name="name"
                                        :placeholder="
                                            $t('central.plans.name_placeholder')
                                        "
                                    />
                                    <has-error :form="form" field="name" />
                                </div>

                                <!-- <div class="form-group col-md-6">
                  <label for="interval">
                    {{ $t('central.plans.interval') }}
                    <span class="required">*</span>
                  </label>
                  <select id="interval" v-model="form.interval" class="form-control"
                    :class="{ 'is-invalid': form.errors.has('interval') }" disabled>
                    <option value="month">{{ $t('common.month') }}</option>
                  </select>
                  <has-error :form="form" field="interval" />
                </div> -->

                                <div class="form-group col-md-6">
                                    <label for="amount">
                                        {{ $t('central.plans.amount') }}
                                        <span class="required">*</span>
                                    </label>
                                    <input
                                        id="amount"
                                        v-model="form.amount"
                                        type="number"
                                        class="form-control"
                                        :class="{
                                            'is-invalid':
                                                form.errors.has('amount'),
                                        }"
                                        name="amount"
                                        :placeholder="
                                            $t(
                                                'central.plans.amount_placeholder'
                                            )
                                        "
                                    />
                                    <has-error :form="form" field="amount" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="note">{{
                                    $t('central.plans.description')
                                }}</label>
                                <textarea
                                    id="description"
                                    v-model="form.description"
                                    class="form-control"
                                    :class="{
                                        'is-invalid':
                                            form.errors.has('description'),
                                    }"
                                    :placeholder="
                                        $t(
                                            'central.plans.description_placeholder'
                                        )
                                    "
                                />
                                <has-error :form="form" field="description" />
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="limit_clients"
                                        >{{ $t('central.plans.limit_clients') }}
                                        <span class="required">*</span>
                                        <span class="text-sm text-muted"
                                            >({{
                                                $t(
                                                    'central.plans.0_means_unlimited'
                                                )
                                            }})</span
                                        >
                                    </label>
                                    <input
                                        id="limit_clients"
                                        v-model="form.limit_clients"
                                        type="number"
                                        class="form-control"
                                        :class="{
                                            'is-invalid':
                                                form.errors.has(
                                                    'limit_clients'
                                                ),
                                        }"
                                        name="limit_clients"
                                        :placeholder="
                                            $t(
                                                'central.plans.limit_clients_placeholder'
                                            )
                                        "
                                    />
                                    <has-error
                                        :form="form"
                                        field="limit_clients"
                                    />
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="limit_suppliers"
                                        >{{
                                            $t('central.plans.limit_suppliers')
                                        }}
                                        <span class="required">*</span>
                                        <span class="text-sm text-muted"
                                            >({{
                                                $t(
                                                    'central.plans.0_means_unlimited'
                                                )
                                            }})</span
                                        >
                                    </label>
                                    <input
                                        id="limit_suppliers"
                                        v-model="form.limit_suppliers"
                                        type="number"
                                        class="form-control"
                                        :class="{
                                            'is-invalid':
                                                form.errors.has(
                                                    'limit_suppliers'
                                                ),
                                        }"
                                        name="limit_suppliers"
                                        :placeholder="
                                            $t(
                                                'plans.limit_suppliers_placeholder'
                                            )
                                        "
                                    />
                                    <has-error
                                        :form="form"
                                        field="limit_suppliers"
                                    />
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="limit_employees"
                                        >{{
                                            $t('central.plans.limit_employees')
                                        }}
                                        <span class="required">*</span>
                                        <span class="text-sm text-muted"
                                            >({{
                                                $t(
                                                    'central.plans.0_means_unlimited'
                                                )
                                            }})</span
                                        >
                                    </label>
                                    <input
                                        id="limit_employees"
                                        v-model="form.limit_employees"
                                        type="number"
                                        class="form-control"
                                        :class="{
                                            'is-invalid':
                                                form.errors.has(
                                                    'limit_employees'
                                                ),
                                        }"
                                        name="limit_employees"
                                        :placeholder="
                                            $t(
                                                'central.plans.limit_employees_placeholder'
                                            )
                                        "
                                    />
                                    <has-error
                                        :form="form"
                                        field="limit_employees"
                                    />
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="limit_domains">
                                        {{ $t('central.plans.limit_domains') }}
                                        <span class="required">*</span>
                                        <span class="text-sm text-muted">
                                            ({{
                                                $t(
                                                    'central.plans.0_means_unlimited'
                                                )
                                            }})
                                        </span>
                                    </label>
                                    <input
                                        id="limit_domains"
                                        v-model="form.limit_domains"
                                        type="number"
                                        class="form-control"
                                        :class="{
                                            'is-invalid':
                                                form.errors.has(
                                                    'limit_domains'
                                                ),
                                        }"
                                        name="limit_domains"
                                        :placeholder="
                                            $t(
                                                'central.plans.limit_domains_placeholder'
                                            )
                                        "
                                    />
                                    <has-error
                                        :form="form"
                                        field="limit_domains"
                                    />
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="limit_purchases">
                                        {{
                                            $t('central.plans.limit_purchases')
                                        }}
                                        <span class="required">*</span>
                                        <span class="text-sm text-muted">
                                            ({{
                                                $t(
                                                    'central.plans.0_means_unlimited'
                                                )
                                            }})
                                        </span>
                                    </label>
                                    <input
                                        id="limit_purchases"
                                        v-model="form.limit_purchases"
                                        type="number"
                                        class="form-control"
                                        :class="{
                                            'is-invalid':
                                                form.errors.has(
                                                    'limit_purchases'
                                                ),
                                        }"
                                        name="limit_purchases"
                                        :placeholder="
                                            $t(
                                                'central.plans.limit_purchases_placeholder'
                                            )
                                        "
                                    />
                                    <has-error
                                        :form="form"
                                        field="limit_purchases"
                                    />
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="limit_invoices">
                                        {{ $t('central.plans.limit_invoices') }}
                                        <span class="required">*</span>
                                        <span class="text-sm text-muted">
                                            ({{
                                                $t(
                                                    'central.plans.0_means_unlimited'
                                                )
                                            }})
                                        </span>
                                    </label>
                                    <input
                                        id="limit_invoices"
                                        v-model="form.limit_invoices"
                                        type="number"
                                        class="form-control"
                                        :class="{
                                            'is-invalid':
                                                form.errors.has(
                                                    'limit_invoices'
                                                ),
                                        }"
                                        name="limit_invoices"
                                        :placeholder="
                                            $t(
                                                'central.plans.limit_invoices_placeholder'
                                            )
                                        "
                                    />
                                    <has-error
                                        :form="form"
                                        field="limit_invoices"
                                    />
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="features">
                                        {{ $t('Pricing features') }}
                                        <span class="required">*</span>
                                    </label>
                                    <v-select
                                        v-model="form.features"
                                        :options="features"
                                        label="name"
                                        :placeholder="
                                            $t('Select pricing features')
                                        "
                                        multiple
                                        :class="{
                                            'is-invalid':
                                                form.errors.has('features'),
                                        }"
                                    />
                                    <has-error :form="form" field="features" />
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="image"
                                        >{{ $t('central.plans.image') }}
                                        <span class="required">*</span></label
                                    >
                                    <div class="custom-file">
                                        <input
                                            id="image"
                                            type="file"
                                            class="custom-file-input"
                                            name="image"
                                            :class="{
                                                'is-invalid':
                                                    form.errors.has('image'),
                                            }"
                                            @change="onFileChange"
                                        />
                                        <label
                                            class="custom-file-label"
                                            for="image"
                                            >{{
                                                $t('common.choose_file')
                                            }}</label
                                        >
                                    </div>
                                    <has-error :form="form" field="image" />
                                    <div v-if="url" class="bg-light mt-4 w-25">
                                        <img
                                            :src="url"
                                            class="img-fluid"
                                            :alt="$t('common.image_alt')"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <v-button
                                :loading="form.busy"
                                class="btn btn-primary"
                            >
                                <i class="fas fa-save" />
                                {{ $t('common.save') }}
                            </v-button>
                            <button
                                type="reset"
                                class="btn btn-secondary float-right"
                                @click="form.reset()"
                            >
                                <i class="fas fa-power-off" />
                                {{ $t('common.reset') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from 'vform';
import axios from 'axios';

export default {
    layout: 'central',
    middleware: ['auth', 'check-permissions'],
    metaInfo() {
        return { title: this.$t('central.plans.create.page_title') };
    },
    data: () => ({
        breadcrumbsCurrent: 'central.plans.create.breadcrumbs_current',
        breadcrumbs: [
            {
                name: 'central.plans.create.breadcrumbs_first',
                url: 'home',
            },
            {
                name: 'central.plans.create.breadcrumbs_second',
                url: 'plans.index',
            },
            {
                name: 'central.plans.create.breadcrumbs_current',
                url: '',
            },
        ],
        url: null,
        form: new Form({
            image: '',
            name: '',
            amount: 0,
            currency: 'usd',
            interval: 'month',
            description: '',
            limit_clients: 0,
            limit_suppliers: 0,
            limit_employees: 0,
            limit_domains: 0,
            limit_purchases: 0,
            limit_invoices: 0,
            features: [],
        }),
        features: [],
        isDemoMode: window.config.isDemoMode,
    }),
    created() {
        this.getFeatures();
    },
    methods: {
        // get features
        async getFeatures() {
            const { data } = await axios.get(
                window.location.origin + '/api/features'
            );
            this.features = data.data;
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
                reader.onloadend = () => {
                    this.form.image = reader.result;
                };
                reader.readAsDataURL(file);
                this.url = URL.createObjectURL(file);
            } else {
                Swal.fire(
                    this.$t('common.error'),
                    this.$t('common.image_error'),
                    'error'
                );
            }
        },

        // save plan
        async savePlan() {
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
                .post(window.location.origin + '/api/plans')
                .then(() => {
                    toast.fire({
                        type: 'success',
                        title: this.$t('central.plans.create.success_msg'),
                    });
                    this.$router.push({ name: 'plans.index' });
                })
                .catch(() => {
                    toast.fire({
                        type: 'error',
                        title: this.$t('common.error'),
                    });
                });
        },
    },
};
</script>

<style lang="scss" scoped></style>
