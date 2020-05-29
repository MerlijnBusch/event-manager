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
                                <input class="form-color-input" id="color" v-model="color" type="color" name="color"
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
    import dropdown from '@/js/components/dropdown';

    export default {
        components: {dropdown},
        data() {
            return {
                role_id: null,
                role_name: '',
                color: '',
                permissions: [],
                options: [],
                current: ["Admin"],
            }
        },
        name: 'UpdateRollModal',
        props: ['id'],
        methods: {
            close() {
                this.$emit('close');
            },
            setCurrent(v){
                this.current = v;
            },
            checkForm: function (e) {


                const data = {
                    color: this.color,
                    role_name: this.role_name,
                    permissions: this.current,
                };

                API.post(data, '/api/role/' + this.role_id, true);

                this.close();

                e.preventDefault();
            },
            setFormData(data){
                const res = data.data;
                this.role_id = res.id;
                this.color = res.color;
                this.role_name = res.role_name;
                this.current = res.permissions;
            }
        },
        watch: {
            id: async function(newVal, oldVal) {
                if(this.id) this.setFormData(await API.get('/api/role/' + this.id));
            }
        },
        async mounted() {
            const data = await API.get('/api/permissions');
            let options = this.options;
            for (const key in data.data.message) {
                if (data.data.message.hasOwnProperty(key) && key.substring(0, 2) === "__") {
                    options.push(data.data.message[key]);
                }
            }
            this.options = options;
            if(this.id) this.setFormData(await API.get('/api/role/' + this.id));
        }
    };
</script>

