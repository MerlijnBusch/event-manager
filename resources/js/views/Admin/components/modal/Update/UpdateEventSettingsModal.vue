<template>
    <transition name="modal-fade">
        <div class="admin-modal-backdrop">
            <div class="admin-modal"
                 role="dialog"
                 aria-labelledby="modalTitle"
                 aria-describedby="modalDescription"
            >
                <header
                    class="admin-modal-header"
                    id="modalTitle"
                >
                    <slot name="header">
                        <p
                            class="admin-modal-title"
                        >
                            Update Event Settings
                        </p>

                        <button
                            type="button"
                            class="admin-modal-btn-close"
                            @click="close"
                            aria-label="Close modal"
                        >
                            x
                        </button>
                    </slot>
                </header>
                <section
                    class="admin-modal-body"
                    id="modalDescription"
                >
                    <slot name="body">

                        <form class="form" @submit.prevent="checkForm" method="post">

                            <date-picker v-model="date_start" @update="(v)=>{date_start = v}"></date-picker>
                            <date-picker v-model="date_end" @update="(v)=>{date_end = v}"></date-picker>

                            <div class="form-line admin-from-submit">
                                <input type="submit" value="Submit" class="submit-btn admin-form-submit">
                            </div>
                        </form>

                    </slot>
                </section>
                <footer class="admin-modal-footer">
                    <slot name="footer">
                        <button
                            type="button"
                            class="admin-modal-btn-green"
                            @click="close"
                            aria-label="Close modal"
                        >
                            Close
                        </button>
                    </slot>
                </footer>
            </div>
        </div>
    </transition>
</template>

<script>
    import API from "../../../../../Api";
    import DatePicker from "../../../../../components/datePicker";

    export default {
        components: {DatePicker},
        data() {
            return {
                date_end: null,
                date_start: null,
                max_registrations: null,
                visible_registrations: null,
                primary_color: null,
                secondary_color: null,
            }
        },
        name: 'UpdateEventSettingsModal',
        props: ['settings'],
        methods: {
            close() {
                this.$emit('close');
            },
            checkForm: function (e) {

                const data = {
                    program_id: this.id,
                    date_start: this.date_start,
                    date_end: this.date_end,
                };

                API.post(data, '/api/block');

                this.close();

                e.preventDefault();
            },
            mounted() {
                this.date_end = this.settings.date_end;
                this.date_start = this.settings.date_start;
                this.max_registrations = this.settings.max_registrations;
                this.visible_registrations = this.settings.visible_registrations;
                this.primary_color = this.settings.primary_color;
                this.secondary_color = this.settings.secondary_color;
            },
        },
    };
</script>

