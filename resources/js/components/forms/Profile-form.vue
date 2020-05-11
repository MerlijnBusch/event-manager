<template>
    <form
        id="app"
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
        <p>
            <label class="form-label" for="image">Image url</label>
            <input
                class="text-input"
                id="image"
                v-model="image"
                type="number"
                name="image"
                placeholder="Item name"
            >
        </p>
        <p>
            <label class="form-label" for="phone_number">Phone number</label>
            <textarea
                class="text-input"
                id="phone_number"
                v-model="phone_number"
                type="phone_number"
                name="phone_number"
                placeholder="Phone number"
            ></textarea>
        </p>
        <p>
            <input
                type="submit"
                value="Submit"
                class="submit-btn"
            >
        </p>
    </form>
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
