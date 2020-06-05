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
                            Create Event Settings
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

                            <div class="form-line">
                                <label class="form-label" for="max_registrations">max registrations</label>
                                <input class="form-text-input" id="max_registrations" v-model="max_registrations" type="text" name="max_registrations"
                                       placeholder="Event name">
                            </div>

                            <div class="form-line">
                                <label class="form-label" for="visible_registrations">visible registrations</label>
                                <input class="form-text-input" id="visible_registrations" v-model="visible_registrations" type="text" name="visible_registrations"
                                       placeholder="Event name">
                            </div>

                            <div class="form-line">
                                <label class="form-label" for="color">Color</label>
                                <input class="form-color-input" id="color" v-model="color" type="color" name="color"
                                       placeholder="Event name">
                            </div>

                            <div class="form-line">
                                <label class="form-label" for="light_theme">Light themed</label>
                                <input class="form-text-input" id="light_theme" v-model="light_theme" type="checkbox" name="light_theme"
                                       placeholder="Event name">
                            </div>

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
                event_id: null,
                date_end: null,
                date_start: null,
                max_registrations: null,
                visible_registrations: null,
                color: '#000000',
                light_theme: false,
            }
        },
        name: 'CreateEventSettingsModal',
        props: ['id'],
        methods: {
            close() {
                this.$emit('close');
            },
            checkForm: function (e) {

                const data = {
                    event_id: this.id,
                    date_end: this.date_end,
                    date_start: this.date_start,
                    max_registrations: this.max_registrations,
                    visible_registrations: this.visible_registrations,
                    color: this.color,
                    light_theme: this.light_theme,
                };

                API.post(data, '/api/event-settings');

                this.close();

                e.preventDefault();
            }
        },
        mounted(){
            console.log(this.id)
        }
    };
</script>

