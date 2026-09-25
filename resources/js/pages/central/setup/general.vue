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
                <form
                    role="form"
                    @submit.prevent="updateSettings"
                    @keydown="form.onKeydown($event)"
                >
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                {{
                                    $t(
                                        'setup.general_settings.index.page_title'
                                    )
                                }}
                            </h3>
                            <router-link
                                :to="{ name: 'setup.index' }"
                                class="btn btn-dark float-right"
                            >
                                <i class="fas fa-long-arrow-alt-left" />
                                {{ $t('common.back') }}
                            </router-link>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="card inner-card">
                                <div class="card-header">
                                    {{
                                        $t(
                                            'setup.general_settings.index.company_info.info_title'
                                        )
                                    }}
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="companyName"
                                                >{{
                                                    $t('common.company_name')
                                                }}
                                                <span class="required"
                                                    >*</span
                                                ></label
                                            >
                                            <input
                                                id="companyName"
                                                v-model="form.companyName"
                                                type="text"
                                                class="form-control"
                                                :class="{
                                                    'is-invalid':
                                                        form.errors.has('name'),
                                                }"
                                                name="companyName"
                                                :placeholder="
                                                    $t(
                                                        'common.company_name_placeholder'
                                                    )
                                                "
                                            />
                                            <has-error
                                                :form="form"
                                                field="companyName"
                                            />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="companyTagline"
                                                >{{
                                                    $t(
                                                        'central.setup.general_settings.index.company_info.company_tagline'
                                                    )
                                                }}
                                                <span class="required"
                                                    >*</span
                                                ></label
                                            >
                                            <input
                                                id="companyTagline"
                                                v-model="form.companyTagline"
                                                type="text"
                                                class="form-control"
                                                :class="{
                                                    'is-invalid':
                                                        form.errors.has(
                                                            'companyTagline'
                                                        ),
                                                }"
                                                name="companyTagline"
                                                :placeholder="
                                                    $t(
                                                        'setup.general_settings.index.company_info.company_tagline_placeholder'
                                                    )
                                                "
                                            />
                                            <has-error
                                                :form="form"
                                                field="companyTagline"
                                            />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="emailAddress"
                                                >{{
                                                    $t(
                                                        'setup.general_settings.index.company_info.email_address'
                                                    )
                                                }}
                                                <span class="required"
                                                    >*</span
                                                ></label
                                            >
                                            <input
                                                id="emailAddress"
                                                v-model="form.emailAddress"
                                                type="email"
                                                class="form-control"
                                                :class="{
                                                    'is-invalid':
                                                        form.errors.has(
                                                            'emailAddress'
                                                        ),
                                                }"
                                                name="emailAddress"
                                                :placeholder="
                                                    $t(
                                                        'setup.general_settings.index.company_info.email_address_placeholder'
                                                    )
                                                "
                                            />
                                            <has-error
                                                :form="form"
                                                field="emailAddress"
                                            />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="phoneNumber"
                                                >{{
                                                    $t(
                                                        'setup.general_settings.index.company_info.phone_number'
                                                    )
                                                }}
                                                <span class="required"
                                                    >*</span
                                                ></label
                                            >
                                            <input
                                                id="phoneNumber"
                                                v-model="form.phoneNumber"
                                                type="text"
                                                class="form-control"
                                                :class="{
                                                    'is-invalid':
                                                        form.errors.has(
                                                            'phoneNumber'
                                                        ),
                                                }"
                                                name="phoneNumber"
                                                :placeholder="
                                                    $t(
                                                        'setup.general_settings.index.company_info.phone_number_placeholder'
                                                    )
                                                "
                                            />
                                            <has-error
                                                :form="form"
                                                field="name"
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">{{
                                            $t('common.address')
                                        }}</label>
                                        <textarea
                                            id="address"
                                            v-model="form.address"
                                            class="form-control"
                                            :class="{
                                                'is-invalid':
                                                    form.errors.has('address'),
                                            }"
                                            :placeholder="
                                                $t('common.address_placeholder')
                                            "
                                        />
                                        <has-error
                                            :form="form"
                                            field="address"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class="card inner-card">
                                <div class="card-header">
                                    {{
                                        $t(
                                            'central.setup.general_settings.index.default_elements.default_elements_title'
                                        )
                                    }}
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="trial_day_count">
                                                {{
                                                    $t(
                                                        'central.setup.general_settings.index.company_info.trial_day_count'
                                                    )
                                                }}
                                                <span class="required"
                                                    >*</span
                                                ></label
                                            >
                                            <input
                                                id="trial_day_count"
                                                v-model="form.trial_day_count"
                                                type="number"
                                                min="0"
                                                class="form-control"
                                                :class="{
                                                    'is-invalid':
                                                        form.errors.has(
                                                            'trial_day_count'
                                                        ),
                                                }"
                                                name="trial_day_count"
                                                :placeholder="
                                                    $t(
                                                        'setup.general_settings.index.trial_day_count_placeholder'
                                                    )
                                                "
                                            />
                                            <has-error
                                                :form="form"
                                                field="trial_day_count"
                                            />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="language"
                                                >{{
                                                    $t(
                                                        'central.setup.general_settings.index.default_elements.default_language'
                                                    )
                                                }}
                                                <span class="required"
                                                    >*</span
                                                ></label
                                            >
                                            <select
                                                v-model="form.language"
                                                name=""
                                                class="form-control"
                                                :class="{
                                                    'is-invalid':
                                                        form.errors.has(
                                                            'language'
                                                        ),
                                                }"
                                            >
                                                <option value="en">
                                                    {{
                                                        $t(
                                                            'central.setup.general_settings.index.default_elements.english_en'
                                                        )
                                                    }}
                                                </option>
                                                <option value="hi">
                                                    {{
                                                        $t(
                                                            'central.setup.general_settings.index.default_elements.hindi_hi'
                                                        )
                                                    }}
                                                </option>
                                            </select>
                                            <has-error
                                                :form="form"
                                                field="language"
                                            />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="currency">{{
                                                $t(
                                                "setup.general_settings.index.default_elements.default_currency"
                                                )
                                            }}
                                                <span class="required">*</span></label>
                                            <v-select v-model="form.currency" :options="items" label="label" :disabled="appInfo.hasDataInCentralPaymentTable"
                                                :class="{ 'is-invalid': form.errors.has('currency') }" name="currency" :placeholder="$t(
                                                'setup.general_settings.index.default_elements.select_a_currency'
                                                )
                                                " />
                                            <has-error :form="form" field="currency" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="copyrightText"
                                                >{{
                                                    $t(
                                                        'central.setup.general_settings.index.default_elements.copyright_text'
                                                    )
                                                }}
                                                <span class="required"
                                                    >*</span
                                                ></label
                                            >
                                            <input
                                                id="copyrightText"
                                                v-model="form.copyrightText"
                                                type="text"
                                                class="form-control"
                                                :class="{
                                                    'is-invalid':
                                                        form.errors.has(
                                                            'copyrightText'
                                                        ),
                                                }"
                                                name="copyrightText"
                                                placeholder="$t('central.setup.general_settings.index.default_elements.copyright_text_placeholder')"
                                            />
                                            <has-error
                                                :form="form"
                                                field="copyrightText"
                                            />
                                        </div>

                                        <!-- social media links -->
                                        <div class="form-group col-md-6">
                                            <label for="facebook_link">{{
                                                $t(
                                                    'central.setup.general_settings.index.default_elements.facebook_link'
                                                )
                                            }}</label>
                                            <input
                                                id="facebook_link"
                                                v-model="form.facebook_link"
                                                type="url"
                                                class="form-control"
                                                :class="{
                                                    'is-invalid':
                                                        form.errors.has(
                                                            'facebook_link'
                                                        ),
                                                }"
                                                name="facebook_link"
                                                placeholder="$t('central.setup.general_settings.index.default_elements.facebook_link_placeholder')"
                                            />
                                            <has-error
                                                :form="form"
                                                field="facebook_link"
                                            />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="instagram_link">{{
                                                $t(
                                                    'central.setup.general_settings.index.default_elements.instagram_link'
                                                )
                                            }}</label>
                                            <input
                                                id="instagram_link"
                                                v-model="form.instagram_link"
                                                type="url"
                                                class="form-control"
                                                :class="{
                                                    'is-invalid':
                                                        form.errors.has(
                                                            'instagram_link'
                                                        ),
                                                }"
                                                name="instagram_link"
                                                placeholder="$t('central.setup.general_settings.index.default_elements.instagram_link_placeholder')"
                                            />
                                            <has-error
                                                :form="form"
                                                field="instagram_link"
                                            />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="twitter_link">{{
                                                $t(
                                                    'central.setup.general_settings.index.default_elements.twitter_link'
                                                )
                                            }}</label>
                                            <input
                                                id="twitter_link"
                                                v-model="form.twitter_link"
                                                type="url"
                                                class="form-control"
                                                :class="{
                                                    'is-invalid':
                                                        form.errors.has(
                                                            'twitter_link'
                                                        ),
                                                }"
                                                name="twitter_link"
                                                placeholder="$t('central.setup.general_settings.index.default_elements.twitter_link_placeholder')"
                                            />
                                            <has-error
                                                :form="form"
                                                field="twitter_link"
                                            />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="linkedin_link">{{
                                                $t(
                                                    'central.setup.general_settings.index.default_elements.linkedin_link'
                                                )
                                            }}</label>
                                            <input
                                                id="linkedin_link"
                                                v-model="form.linkedin_link"
                                                type="url"
                                                class="form-control"
                                                :class="{
                                                    'is-invalid':
                                                        form.errors.has(
                                                            'linkedin_link'
                                                        ),
                                                }"
                                                name="linkedin_link"
                                                placeholder="$t('central.setup.general_settings.index.default_elements.linkedin_link_placeholder')"
                                            />
                                            <has-error
                                                :form="form"
                                                field="linkedin_link"
                                            />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="logo">{{
                                                $t(
                                                    'setup.general_settings.index.logo.white_logo'
                                                )
                                            }}</label>
                                            <div class="custom-file">
                                                <input
                                                    id="logo"
                                                    type="file"
                                                    class="custom-file-input"
                                                    name="logo"
                                                    :class="{
                                                        'is-invalid':
                                                            form.errors.has(
                                                                'logo'
                                                            ),
                                                    }"
                                                    @change="onLogoChange"
                                                />
                                                <label
                                                    class="custom-file-label"
                                                    for="logo"
                                                    >{{
                                                        $t('common.choose_file')
                                                    }}</label
                                                >
                                            </div>
                                            <has-error
                                                :form="form"
                                                field="logo"
                                            />
                                            <div class="bg-light mt-4 w-25">
                                                <img
                                                    v-if="logo"
                                                    :src="logo"
                                                    class="img-fluid"
                                                    alt="Logo"
                                                />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="blackLogo">{{
                                                $t(
                                                    'setup.general_settings.index.logo.black_logo'
                                                )
                                            }}</label>
                                            <div class="custom-file">
                                                <input
                                                    id="blackLogo"
                                                    type="file"
                                                    class="custom-file-input"
                                                    name="blackLogo"
                                                    :class="{
                                                        'is-invalid':
                                                            form.errors.has(
                                                                'blackLogo'
                                                            ),
                                                    }"
                                                    @change="onBlackLogoChange"
                                                />
                                                <label
                                                    class="custom-file-label"
                                                    for="blackLogo"
                                                    >{{
                                                        $t('common.choose_file')
                                                    }}</label
                                                >
                                            </div>
                                            <has-error
                                                :form="form"
                                                field="blackLogo"
                                            />
                                            <div class="bg-light mt-4 w-25">
                                                <img
                                                    v-if="blackLogo"
                                                    :src="blackLogo"
                                                    class="img-fluid"
                                                    alt="Black Logo"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="smallLogo">{{
                                                $t(
                                                    'setup.general_settings.index.logo.small_logo'
                                                )
                                            }}</label>
                                            <div class="custom-file">
                                                <input
                                                    id="smallLogo"
                                                    type="file"
                                                    class="custom-file-input"
                                                    name="smallLogo"
                                                    :class="{
                                                        'is-invalid':
                                                            form.errors.has(
                                                                'smallLogo'
                                                            ),
                                                    }"
                                                    @change="onSmallLogoChange"
                                                />
                                                <label
                                                    class="custom-file-label"
                                                    for="smallLogo"
                                                    >{{
                                                        $t('common.choose_file')
                                                    }}</label
                                                >
                                            </div>
                                            <has-error
                                                :form="form"
                                                field="smallLogo"
                                            />
                                            <div class="bg-light mt-4 w-25">
                                                <img
                                                    v-if="smallLogo"
                                                    :src="smallLogo"
                                                    class="img-fluid"
                                                    alt="Small Logo"
                                                />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="favicon">{{
                                                $t(
                                                    'setup.general_settings.index.logo.favicon'
                                                )
                                            }}</label>
                                            <div class="custom-file">
                                                <input
                                                    id="favicon"
                                                    type="file"
                                                    class="custom-file-input"
                                                    name="favicon"
                                                    :class="{
                                                        'is-invalid':
                                                            form.errors.has(
                                                                'favicon'
                                                            ),
                                                    }"
                                                    @change="onFaviconChange"
                                                />
                                                <label
                                                    class="custom-file-label"
                                                    for="favicon"
                                                    >{{
                                                        $t('common.choose_file')
                                                    }}</label
                                                >
                                            </div>
                                            <has-error
                                                :form="form"
                                                field="favicon"
                                            />
                                            <div class="bg-light mt-4 w-25">
                                                <img
                                                    v-if="favicon"
                                                    :src="favicon"
                                                    class="img-fluid"
                                                    alt="Favicon"
                                                />
                                            </div>
                                        </div>
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
                                <i class="fas fa-edit" />
                                {{ $t('common.save_changes') }}
                            </v-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Form from 'vform';
import { mapGetters } from 'vuex';
import { loadMessages } from '~/plugins/i18n';
import SettingsSidebar from '~/components/central/SettingsSidebar';

export default {
    layout: 'central',
    middleware: ['auth', 'check-permissions'],
    metaInfo() {
        return { title: this.$t('setup.general_settings.index.page_title') };
    },
    components: {
        SettingsSidebar,
    },
    data: () => ({
        isDemoMode: window.config.isDemoMode,
        breadcrumbsCurrent: 'setup.general_settings.index.breadcrumbs_current',
        breadcrumbs: [
            {
                name: 'setup.general_settings.index.breadcrumbs_first',
                url: 'home',
            },
            {
                name: 'setup.general_settings.index.breadcrumbs_second',
                url: 'setup.index',
            },
            {
                name: 'setup.general_settings.index.breadcrumbs_active',
                url: '',
            },
        ],
        form: new Form({
            companyName: '',
            companyTagline: '',
            emailAddress: '',
            phoneNumber: '',
            address: '',
            clientPrefix: '',
            supplierPrefix: '',
            employeePrefix: '',
            proCatPrefix: '',
            proSubCatPrefix: '',
            productPrefix: '',
            expCatPrefix: '',
            expSubCatPrefix: '',
            purchasePrefix: '',
            purchaseReturnPrefix: '',
            quotationPrefix: '',
            invoicePrefix: '',
            invoiceReturnPrefix: '',
            adjustmentPrefix: '',
            language: 'en',
            copyrightText: '',
            logo: '',
            blackLogo: '',
            currency: "",
            smallLogo: '',
            favicon: '',
            facebook_link: '',
            instagram_link: '',
            twitter_link: '',
            linkedin_link: '',
            trial_day_count: 14,
        }),
        logo: '',
        blackLogo: '',
        smallLogo: '',
        favicon: '',
    }),
    computed: mapGetters({
        appInfo: 'operations/appInfo',
        items: 'operations/items',
    }),

    created() {
        this.assignValues();
        this.getCurrencies();
    },

    methods: {
         // get currencies
        async getCurrencies() {
        await this.$store.dispatch("operations/allData", {
            path: "/api/all-currencies",
        });
        },

        // assign values
        assignValues() {
            if (this.appInfo) {
                this.form.companyName = this.appInfo.companyName;
                this.form.companyTagline = this.appInfo.companyTagline;
                this.form.emailAddress = this.appInfo.email;
                this.form.phoneNumber = this.appInfo.phone;
                this.form.address = this.appInfo.address;
                this.form.clientPrefix = this.appInfo.clientPrefix;
                this.form.supplierPrefix = this.appInfo.supplierPrefix;
                this.form.employeePrefix = this.appInfo.employeePrefix;
                this.form.proCatPrefix = this.appInfo.proCatPrefix;
                this.form.proSubCatPrefix = this.appInfo.proSubCatPrefix;
                this.form.productPrefix = this.appInfo.productPrefix;
                this.form.expCatPrefix = this.appInfo.expCatPrefix;
                this.form.expSubCatPrefix = this.appInfo.expSubCatPrefix;
                this.form.purchasePrefix = this.appInfo.purchasePrefix;
                this.form.purchaseReturnPrefix =
                    this.appInfo.purchaseReturnPrefix;
                this.form.quotationPrefix = this.appInfo.quotationPrefix;
                this.form.invoicePrefix = this.appInfo.invoicePrefix;
                this.form.invoiceReturnPrefix =
                    this.appInfo.invoiceReturnPrefix;
                this.form.adjustmentPrefix = this.appInfo.adjustmentPrefix;
                this.form.currency = this.appInfo.currency;
                this.form.language = this.appInfo.language;
                this.logo = this.appInfo.logo;
                this.blackLogo = this.appInfo.blackLogo;
                this.smallLogo = this.appInfo.smallLogo;
                this.favicon = this.appInfo.favicon;
                this.form.copyrightText = this.appInfo.copyright;
                this.form.facebook_link = this.appInfo.facebook_link;
                this.form.instagram_link = this.appInfo.instagram_link;
                this.form.twitter_link = this.appInfo.twitter_link;
                this.form.linkedin_link = this.appInfo.linkedin_link;
                this.form.trial_day_count = this.appInfo.trial_day_count;
            }
        },

        // vue logo upload
        onLogoChange(e) {
            const file = e.target.files[0];
            const reader = new FileReader();
            if (
                file.size < 2111775 &&
                (file.type === 'image/jpeg' ||
                    file.type === 'image/png' ||
                    file.type === 'image/gif' ||
                    file.type === 'image/svg')
            ) {
                reader.onloadend = () => {
                    this.form.logo = reader.result;
                };
                reader.readAsDataURL(file);
                this.logo = URL.createObjectURL(file);
            } else {
                Swal.fire(
                    this.$t('common.error'),
                    this.$t('common.image_error'),
                    'error'
                );
            }
        },

        // vue black logo upload
        onBlackLogoChange(e) {
            const file = e.target.files[0];
            const reader = new FileReader();
            if (
                file.size < 2111775 &&
                (file.type === 'image/jpeg' ||
                    file.type === 'image/png' ||
                    file.type === 'image/gif' ||
                    file.type === 'image/svg')
            ) {
                reader.onloadend = () => {
                    this.form.blackLogo = reader.result;
                };
                reader.readAsDataURL(file);
                this.blackLogo = URL.createObjectURL(file);
            } else {
                Swal.fire(
                    this.$t('common.error'),
                    this.$t('common.image_error'),
                    'error'
                );
            }
        },

        // vue small logo upload
        onSmallLogoChange(e) {
            const file = e.target.files[0];
            const reader = new FileReader();
            if (
                file.size < 2111775 &&
                (file.type === 'image/jpeg' ||
                    file.type === 'image/png' ||
                    file.type === 'image/gif' ||
                    file.type === 'image/svg')
            ) {
                reader.onloadend = () => {
                    this.form.smallLogo = reader.result;
                };
                reader.readAsDataURL(file);
                this.smallLogo = URL.createObjectURL(file);
            } else {
                Swal.fire(
                    this.$t('common.error'),
                    this.$t('common.image_error'),
                    'error'
                );
            }
        },

        // vue favicon upload
        onFaviconChange(e) {
            const file = e.target.files[0];
            const reader = new FileReader();
            if (
                file.size < 2111775 &&
                (file.type === 'image/jpeg' ||
                    file.type === 'image/png' ||
                    file.type === 'image/gif')
            ) {
                reader.onloadend = () => {
                    this.form.favicon = reader.result;
                };
                reader.readAsDataURL(file);
                this.favicon = URL.createObjectURL(file);
            } else {
                Swal.fire(
                    this.$t('common.error'),
                    this.$t('common.image_error'),
                    'error'
                );
            }
        },

        // update settings
        async updateSettings() {
            if (this.isDemoMode) {
                return toast.fire({
                    type: 'warning',
                    title: this.$t(
                        'You are not allowed to do this in demo version.'
                    ),
                });
            }
            // update locale
            let locale = this.form.language;
            if (this.$i18n.locale !== locale) {
                loadMessages(locale);
                this.$store.dispatch('lang/setLocale', { locale });
            }

            await this.form
                .post(window.location.origin + '/api/update-settings')
                .then(() => {
                    toast.fire({
                        type: 'success',
                        title: this.$t(
                            'setup.general_settings.index.success_message'
                        ),
                    });
                    window.location.reload();
                })
                .catch(() => {
                    toast.fire({
                        type: 'error',
                        title: this.$t('common.error_msg'),
                    });
                });
        },
    },
};
</script>

<style lang="scss" scoped>
.inner-card {
    box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
}

.inner-card .card-header {
    background-color: rgba(0, 0, 0, 0.03);
}
</style>
