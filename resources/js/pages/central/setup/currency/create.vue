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
                <form role="form" @submit.prevent="saveCurrency" @keydown="form.onKeydown($event)">
                    <div class="card">
                        <div class="card-header setings-header">
                            <div class="col-xl-4 col-4">
                                <h3 class="card-title">
                                    {{ $t("central.settings_sidebar_create_currency") }}
                                </h3>
                            </div>
                            <div class="col-xl-8 col-8 float-right text-right">
                                <router-link :to="{ name: 'setup.centralCurrency.index' }"
                                    class="btn btn-dark float-right">
                                    <i class="fas fa-long-arrow-alt-left" />
                                    {{ $t("common.back") }}
                                </router-link>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">{{ $t("common.name") }}<span class="required">*</span></label>
                                <input id="name" v-model="form.name" type="text" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('name') }" name="name"
                                    :placeholder="$t('common.name_placeholder')" />
                                <has-error :form="form" field="name" />
                            </div>
                            <div class="form-group">
                                <label for="code">{{ $t("common.code") }}<span class="required">*</span></label>
                                <input id="code" v-model="form.code" type="text" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('code') }" name="code"
                                    :placeholder="$t('common.code_placeholder')" />
                                <has-error :form="form" field="code" />
                            </div>

                            <div class="form-group">
                                <label for="rate">{{ $t("setup.currencies.common.rate")
                                    }}<span class="required">*</span></label>
                                <input id="rate" v-model="form.rate" type="text" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('rate') }" name="rate" :placeholder="$t('setup.currencies.common.central_currency_exchange_rate')
            " />
                                <has-error :form="form" field="rate" />
                            </div>

                            <div class="form-group">
                                <label for="symbol">{{ $t("setup.currencies.common.symbol")
                                    }}<span class="required">*</span></label>
                                <input id="symbol" v-model="form.symbol" type="text" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('symbol') }" name="symbol" :placeholder="$t('setup.currencies.common.symbol_placeholder')
            " />
                                <has-error :form="form" field="symbol" />
                            </div>
                            <div class="form-group">
                                <label for="position">{{
            $t("setup.currencies.common.currency_position")
        }}</label>
                                <select v-model="form.position" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('position') }" name="position">
                                    <option value="left">
                                        {{
            $t("setup.currencies.common.position_drop_down_item_one")
        }}
                                    </option>
                                    <option value="right">
                                        {{
                $t("setup.currencies.common.position_drop_down_item_two")
            }}
                                    </option>
                                </select>
                                <has-error :form="form" field="position" />
                            </div>
                            <div class="form-group">
                                <label for="status">{{ $t("common.status") }}</label>
                                <select id="status" v-model="form.status" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('status') }">
                                    <option value="1">{{ $t("common.active") }}</option>
                                    <option value="0">{{ $t("common.in_active") }}</option>
                                </select>
                                <has-error :form="form" field="status" />
                            </div>

                            <div class="form-group">
                                <label for="note">{{ $t("common.note") }}</label>
                                <textarea id="note" v-model="form.note" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('note') }"
                                    :placeholder="$t('common.note_placeholder')" />
                                <has-error :form="form" field="note" />
                            </div>
                        </div>

                        <div class="card-footer">
                            <v-button :loading="form.busy" class="btn btn-primary">
                                <i class="fas fa-save" /> {{ $t("common.save") }}
                            </v-button>
                            <button type="reset" class="btn btn-secondary float-right" @click="form.reset()">
                                <i class="fas fa-power-off" /> {{ $t("common.reset") }}
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
        return { title: this.$t('central.settings_sidebar_create_currency') }
    },

    components: {
        SettingsSidebar,
    },

    data: () => ({
        breadcrumbsCurrent: 'central.settings_sidebar_create_currency',
        breadcrumbs: [
            {
                name: 'central.setup.user_management.create.breadcrumbs_first',
                url: 'home',
            },
            {
                name: 'central.settings_sidebar_currency',
                url: 'setup.centralCurrency.index',
            },
            {
                name: 'central.setup.user_management.create.breadcrumbs_current',
                url: '',
            },
        ],
        form: new Form({
            name: "",
            note: "",
            status: 1,
            code: "",
            rate: "",
            symbol: "",
            position: "left",
        }),
        loading: true,
    }),

    created() {
    },

    methods: {
        // save currency
        async saveCurrency() {
            await this.form
                .post(window.location.origin + "/api/currencies")
                .then(() => {
                    toast.fire({
                        type: "success",
                        title: this.$t("setup.currencies.create.success_msg"),
                    });
                    this.$router.push({ name: "setup.centralCurrency.index" });
                })
                .catch(() => {
                    toast.fire({
                        type: "error",
                        title: this.$t("common.error_msg"),
                    });
                });
        },
    },
}
</script>

<style lang="scss" scoped></style>