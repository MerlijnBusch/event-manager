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
                            Create Item
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
                                <label class="form-label" for="type">Name</label>
                                <select id="type" v-model="type">
                                    <option value="keynotes">Key notes</option>
                                    <option value="speaker">Speaker</option>
                                    <option value="none">none</option>
                                </select>
                            </div>

                            <date-picker v-model="date_start" @update="(v)=>{date_start = v}"></date-picker>
                            <date-picker v-model="date_end" @update="(v)=>{date_end = v}"></date-picker>

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
    import API from "../../../../Api";
    import DatePicker from "../../../../components/datePicker";

    export default {
        components: {DatePicker},
        data() {
            return {
                name: null,
                type:null,
                description: null,
                date_start: null,
                date_end: null,
                active: false,
            }
        },
        name: 'CreateItemModal',
        props: ['id'],
        methods: {
            close() {
                this.$emit('close');
            },
            checkForm: function (e) {

                const data = {
                    name:  this.name,
                    type: this.type,
                    description:  this.description,
                    block_id:  this.id,
                    date_start:  this.date_start,
                    date_end:  this.date_end,
                    active:  this.active,
                };

                API.post(data, '/api/item');

                this.close();

                e.preventDefault();
            }
        },
    };
</script>

