<template>
    <div>
        <!--- SECTION TITLE FORM START --->
        <div class="card">
            <div class="card-header setings-header">
                <h3 class="card-title">{{ $t('common.pricing_plan') }}</h3>
            </div>
            <form
                class="form-horizontal"
                @submit.prevent="update"
                @keydown="form.onKeydown($event)"
            >
                <div class="card-body">
                    <div class="form-group">
                        <label for="pricing_plan_section_tagline">
                            {{ $t('common.pricing_plan_section_tagline') }}
                            <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            v-model="form.pricing_plan_section_tagline"
                            class="form-control"
                            :class="{
                                'is-invalid': form.errors.has(
                                    'pricing_plan_section_tagline'
                                ),
                            }"
                            id="pricing_plan_section_tagline"
                            :placeholder="
                                $t(
                                    'common.pricing_plan_section_tagline_placeholder'
                                )
                            "
                        />
                        <has-error
                            :form="form"
                            field="pricing_plan_section_tagline"
                        />
                    </div>

                    <div class="form-group">
                        <label for="pricing_plan_section_title">
                            {{ $t('common.pricing_plan_section_title') }}
                            <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            v-model="form.pricing_plan_section_title"
                            class="form-control"
                            :class="{
                                'is-invalid': form.errors.has(
                                    'pricing_plan_section_title'
                                ),
                            }"
                            id="pricing_plan_section_title"
                            :placeholder="
                                $t(
                                    'common.pricing_plan_section_title_placeholder'
                                )
                            "
                        />
                        <has-error
                            :form="form"
                            field="pricing_plan_section_title"
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
    </div>
</template>

<script>
import Form from 'vform';
import axios from 'axios';

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
            pricing_plan_section_tagline: '',
            pricing_plan_section_title: '',
        }),
        user: '',
        isDemoMode: window.config.isDemoMode,
    }),

    created() {
        this.getData();
    },

    methods: {
        // get the user
        async getData() {
            const { data } = await axios.get(
                window.location.origin + '/api/settings/pricing-plan-settings'
            );
            this.user = data.data;
            this.form.fill(data.data);
        },

        // update
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
                        '/api/settings/pricing-plan-settings'
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
    },
};
</script>

<style lang="scss" scoped></style>
