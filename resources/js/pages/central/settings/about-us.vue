<template>
    <div class="card">
        <form
            class="form-horizontal"
            @submit.prevent="update"
            @keydown="form.onKeydown($event)"
        >
            <div class="card-header setings-header">
                <h3 class="card-title">{{ $t('common.about_us') }}</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="about_us_tagline">
                        {{ $t('common.about_us_tagline') }}
                        <span class="required">*</span>
                    </label>
                    <input
                        type="text"
                        v-model="form.about_us_tagline"
                        class="form-control"
                        :class="{
                            'is-invalid': form.errors.has('about_us_tagline'),
                        }"
                        id="about_us_tagline"
                        :placeholder="$t('common.about_us_tagline_placeholder')"
                    />
                    <has-error :form="form" field="about_us_tagline" />
                </div>
                <div class="form-group">
                    <label for="about_us_title">
                        {{ $t('common.about_us_title') }}
                        <span class="required">*</span>
                    </label>
                    <input
                        type="text"
                        v-model="form.about_us_title"
                        class="form-control"
                        :class="{
                            'is-invalid': form.errors.has('about_us_title'),
                        }"
                        id="about_us_title"
                        :placeholder="$t('common.about_us_title_placeholder')"
                    />
                </div>
                <div class="form-group">
                    <label for="about_us_description">
                        {{ $t('common.about_us_description') }}
                        <span class="required">*</span>
                    </label>
                    <textarea
                        v-model="form.about_us_description"
                        class="form-control"
                        :class="{
                            'is-invalid': form.errors.has(
                                'about_us_description'
                            ),
                        }"
                        id="about_us_description"
                        :placeholder="
                            $t('common.about_us_description_placeholder')
                        "
                        rows="4"
                    ></textarea>
                    <has-error :form="form" field="about_us_description" />
                </div>
            </div>
            <div class="card-footer">
                <v-button :loading="form.busy" class="btn btn-primary">
                    <i class="fas fa-edit" /> {{ $t('common.save_changes') }}
                </v-button>
            </div>
        </form>
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
            about_us_tagline: '',
            about_us_title: '',
            about_us_description: '',
        }),
        loading: true,
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
                window.location.origin + '/api/settings/about-us-settings'
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
                    window.location.origin + '/api/settings/about-us-settings'
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
