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
                            Create Event
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

                            <input type="file" name="image" @change="onFileChange">

                            <div class="event-form-preview-image-holder" ref="previewImage"></div>

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
    import create from 'dom-create-element';

    export default {
        data() {
            return {
                name: '',
                description: '',
                image: null,
            }
        },
        name: 'CreateEventModal',
        methods: {
            close() {
                this.$emit('close');
            },
            checkForm: function (e) {

                if (this.image === null) return;

                const data = {
                    name: this.name,
                    description: this.description,
                    image: this.image,
                };

                API.post(data, '/api/event');

                this.close();

                e.preventDefault();
            },
            async onFileChange(e) {
                let base64;
                const file = e.target.files[0];
                const reader = new FileReader();
                const imageTypes = ["png", "jpeg"];
                const prev = this.$refs.previewImage;

                if (!imageTypes.includes(file.type.split('/')[1])) {
                    e.target.value = null;
                    this.image = null;
                    alert('Verkeerde image type toegestaan [png, jpeg]');
                    return;
                }

                reader.onload = function () {
                    base64 = this.result;

                    const image = create({
                        selector: 'img',
                        styles: 'event-form-preview-image',
                    });

                    image.src = base64;
                    prev.innerHTML = '';
                    prev.appendChild(image);
                    console.log(base64)
                };

                await reader.readAsDataURL(file);

                this.image = base64;
            },
        },
    };
</script>

