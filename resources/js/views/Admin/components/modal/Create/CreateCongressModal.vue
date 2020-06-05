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
                            Create Congress
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

                            <div class="form-line">
                                <label class="form-label" for="name">Name</label>
                                <input class="form-text-input" id="name" v-model="name" type="text" name="name"
                                       placeholder="Event name">
                            </div>

                            <div class="form-line">
                                <label class="form-label" for="description">description</label>
                                <textarea class="form-text-input" id="description" v-model="description" type="text" name="description"
                                          placeholder="Event name"></textarea>
                            </div>

                            <div class="form-line">
                                <label class="form-label" for="active">Active</label>
                                <input class="form-text-input" id="active" v-model="active" type="checkbox" name="active"
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
        data() {
            return {
                name: null,
                description: null,
                active: false,
            }
        },
        components: {DatePicker},
        name: 'CreateCongressModal',
        props: ['id'],
        methods: {
            close() {
                this.$emit('close');
            },
            checkForm: function (e) {

                const data = {
                    event_id: this.id,
                    name: this.name,
                    description: this.description,
                    active: this.active,
                };

                API.post(data, '/api/congress');

                this.close();

                e.preventDefault();
            }
        },
    };
</script>

