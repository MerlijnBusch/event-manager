<template>
    <div class="full-page-form">
        <div class="form-holder">
            <form
                class="form"
                @submit.prevent="checkForm"
                method="post"
            >

                <div v-if="errors.length">
                    <b>Please correct the following error(s):</b>
                    <ul>
                        <li v-for="error in errors">{{ error }}</li>
                    </ul>
                </div>

                <h2 class="form-title">
                    Profile form
                </h2>
                <div class="form-line">
                    <label class="form-label" for="image">Image url</label>
                    <input
                        class="form-text-input"
                        id="image"
                        v-model="image"
                        type="url"
                        name="image"
                        placeholder="Item name"
                    >
                </div>
                <div class="form-line">
                    <label class="form-label" for="phone_number">Phone number</label>
                    <input
                        class="form-text-input"
                        id="phone_number"
                        v-model="phone_number"
                        type="text"
                        name="phone_number"
                        placeholder="Phone number"
                    >
                </div>
                <div class="form-line">
                    <input
                        type="submit"
                        value="Submit"
                        class="submit-btn"
                    >
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import API from "../../Api";

    export default {
        data() {
            return {
                errors: [],
                phone_number: null,
                image: null,
            }
        },
        methods: {
            checkForm: function (e) {

                this.errors = [];

                const data = {
                    "phone_number": this.phone_number,
                    "image": this.image,
                }

                API.post(data, '/api/profile');

                e.preventDefault();
            }
        }
    }
</script>
