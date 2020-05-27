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

                        <div class="form-line">
                            <label class="form-label" for="name">Name</label>
                            <input class="form-text-input" id="name" v-model="name" type="text" name="name"
                                   placeholder="Event name">
                        </div>

                        <div class="form-line admin-from-submit">
                            <input type="submit" value="Submit" class="submit-btn admin-form-submit" v-on:click="submit">
                        </div>

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

    export default {
        data() {
            return {}
        },
        name: 'UploadExcelUserModal',
        props: ['id'],
        methods: {
            close() {
                this.$emit('close');
            },
            submit(){

            },
        },
    };
</script>

