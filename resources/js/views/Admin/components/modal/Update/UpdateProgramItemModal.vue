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
                            Update Program Item
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
                                <textarea class="form-text-input" id="description" v-model="description" type="text"
                                          name="description"
                                          placeholder="Event name"></textarea>
                            </div>

                            <date-picker v-model="date" @update="(v)=>{date = v}"></date-picker>

                            <div class="form-line">
                                <label class="form-label" for="active">Active</label>
                                <input class="form-text-input" id="active" v-model="active" type="checkbox" name="active">
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
                name: null,
                description: null,
                date: null,
                active: false,
            }
        },
        name: 'UpdateProgramItemModal',
        props: ['id'],
        methods: {
            close() {
                this.$emit('close');
            },
            checkForm: function (e) {

                const data = {
                    name: this.name,
                    description: this.description,
                    date: this.date,
                    active: this.active,
                };


                API.post(data, '/api/program-item/' + this.id, true);

                this.name = null;
                this.type = null;
                this.description = null;
                this.date = null;
                this.active = false;

                this.close();

                e.preventDefault();
            },
            setFormData(res){
                const data = res.data;
                this.name = data.name;
                this.date = data.date;
                this.description = data.description;
                this.active = data.active;
            }
        },
        watch: {
            id: async function(newVal, oldVal) {
                if(this.id) this.setFormData(await API.get('/api/program-item/' + this.id));
            }
        },
        async mounted() {
            if(this.id)this.setFormData(await API.get('/api/program-item/' + this.id));
        }
    };
</script>

