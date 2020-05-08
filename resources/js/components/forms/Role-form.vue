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
            Event Settings
        </h2>
        <p>
            <label class="form-label" for="role_name">Role Name</label>
            <input
                class="text-input"
                id="role_name"
                v-model="role_name"
                type="number"
                name="role_name"
                placeholder="Role name"
            >
        </p>
        <p>
            <label class="form-label" for="color">Color</label>
            <input
                class="text-input"
                id="color"
                v-model="color"
                type="color"
                name="color"
                placeholder="Color"
            />
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
    import axios from 'axios';
    import functions from "../../functions";

    export default {
        data() {
            return {
                errors: [],
                role_name: '',
                color: '',
                permissions: [],
                options: [],
            }
        },
        methods: {
            checkForm: async function (e) {
                // this.errors = [];
                //
                // const data = {
                //     "event_id": this.event_id,
                //     "name": this.name,
                //     "type": this.type,
                //     "description": this.description,
                //     "date": this.date,
                // }
                // axios.post(window.location.origin + `/api/item`, data, {headers: headers}).then(response => {
                //     if (response.status === 200) {
                //         console.log('success', response)
                //     }
                // }).catch(e => {
                //     this.errors.push(e)
                // })
                //
                // e.preventDefault();
            }
        },
        async mounted() {
            const data = await functions.get(this.$user.data.data.api_token, '/api/permissions');
            for (const key in data.data.message) {
                if (data.data.message.hasOwnProperty(key) && key.substring(0, 2) === "__") this.options.push({name: key, value: data.data.message[key]});
            }
        },
    }
</script>
