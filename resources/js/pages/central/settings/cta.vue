<template>
    <div>
        <!--- SECTION TITLE FORM START --->
        <div class="card">
            <div class="card-header setings-header">
                <h3 class="card-title">
                    {{ $t('common.all_features_and_get_started') }}
                </h3>
            </div>
            <form
                class="form-horizontal"
                @submit.prevent="update"
                @keydown="form.onKeydown($event)"
            >
                <div class="card-body">
                    <div class="form-group">
                        <label for="get_started_box_title">
                            {{ $t('common.get_started_box_title') }}
                            <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            v-model="form.get_started_box_title"
                            class="form-control"
                            :class="{
                                'is-invalid': form.errors.has(
                                    'get_started_box_title'
                                ),
                            }"
                            id="get_started_box_title"
                            :placeholder="
                                $t('common.get_started_box_title_placeholder')
                            "
                        />
                        <has-error :form="form" field="get_started_box_title" />
                    </div>

                    <div class="form-group">
                        <label for="get_started_box_description">
                            {{ $t('common.get_started_box_description') }}
                            <span class="required">*</span>
                        </label>
                        <textarea
                            v-model="form.get_started_box_description"
                            class="form-control"
                            :class="{
                                'is-invalid': form.errors.has(
                                    'get_started_box_description'
                                ),
                            }"
                            id="get_started_box_description"
                            :placeholder="
                                $t(
                                    'common.get_started_box_description_placeholder'
                                )
                            "
                        ></textarea>
                        <has-error
                            :form="form"
                            field="get_started_box_description"
                        />
                    </div>

                    <div class="form-group">
                        <label for="get_started_box_button_text">
                            {{ $t('common.get_started_box_button_text') }}
                            <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            v-model="form.get_started_box_button_text"
                            class="form-control"
                            :class="{
                                'is-invalid': form.errors.has(
                                    'get_started_box_button_text'
                                ),
                            }"
                            id="get_started_box_button_text"
                            :placeholder="
                                $t(
                                    'common.get_started_box_button_text_placeholder'
                                )
                            "
                        />
                        <has-error
                            :form="form"
                            field="get_started_box_button_text"
                        />
                    </div>

                    <div class="form-group">
                        <label for="get_started_box_button_link">
                            {{ $t('common.get_started_box_button_link') }}
                            <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            v-model="form.get_started_box_button_link"
                            class="form-control"
                            :class="{
                                'is-invalid': form.errors.has(
                                    'get_started_box_button_link'
                                ),
                            }"
                            id="get_started_box_button_link"
                            :placeholder="
                                $t(
                                    'common.get_started_box_button_link_placeholder'
                                )
                            "
                        />
                        <has-error
                            :form="form"
                            field="get_started_box_button_link"
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
            get_started_box_title: '',
            get_started_box_description: '',
            get_started_box_button_text: '',
            get_started_box_button_link: '',
        }),
        dataForm: new Form({
            title: '',
            description: '',
            status: '',
            image: '',
        }),
        user: '',
        isDemoMode: window.config.isDemoMode,
    }),

    // Map Getters
    computed: {
        ...mapGetters('operations', ['items', 'loading', 'pagination']),
    },

    created() {
        this.getData();
    },

    methods: {
        // get the user
        async getData() {
            const { data } = await axios.get(
                window.location.origin + '/api/settings/get-started-settings'
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
                        '/api/settings/get-started-settings'
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
