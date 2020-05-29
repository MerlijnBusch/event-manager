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
                            Update Block
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
                                <label class="form-label" for="role_name">Role Name</label>
                                <input class="form-text-input" id="role_name" v-model="role_name" type="text" name="role_name"
                                       placeholder="Role name">
                            </div>
                            <div class="form-line">
                                <label class="form-label" for="color">Color</label>
                                <input class="form-text-input" id="color" v-model="color" type="color" name="color"
                                       placeholder="Color"
                                />
                            </div>
                            <div class="form-line">
                                <dropdown placeholder="role permisions" :options="options" :current="current" @setCurrent="setCurrent"></dropdown>
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
    import dropdown from '@/js/components/dropdown'

    export default {
        components: {dropdown},
        data() {
            return {
                roll_id: null,
                role_name: '',
                color: '',
                permissions: [],
                options: [],
                current: [],
            }
        },
        name: 'UpdateRollModal',
        props: ['id'],
        methods: {
            close() {
                this.$emit('close');
            },
            checkForm: function (e) {


                const data = {
                    date_start: this.date_start,
                    date_end: this.date_end,
                };

                API.post(data, '/api/block/' + this.block_id, true);

                this.close();

                e.preventDefault();
            },
            setFormData(data){
                this.date_start = data.data.date_start;
                this.date_end = data.data.date_end;
                this.block_id = data.data.id;
            }
        },
        watch: {
            id: async function(newVal, oldVal) {
                this.setFormData(await API.get('/api/block/' + this.id));
            }
        },
        async mounted() {
            this.setFormData(await API.get('/api/block/' + this.id));
        }
    };
</script>

