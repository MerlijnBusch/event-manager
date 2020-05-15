<template>
    <div class="full-page-form">
        <div class="form-holder">
            <form class="form" @submit.prevent="checkForm" method="post">
                <h2 class="form-title">Event Settings</h2>

                <div v-if="errors.length">
                    <b>Please correct the following error(s):</b>
                    <ul>
                        <li v-for="error in errors">{{ error }}</li>
                    </ul>
                </div>

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
                <div class="form-line form-line-hasbutton">
                    <input type="submit" class="form-button" value="Submit">
                </div>

            </form>
        </div>
    </div>
</template>

<script>
    import API from "@/js/Api";
    import dropdown from '@/js/components/dropdown'

    export default {
        name: 'Role-Form',
        data() {
            return {
                errors: [],
                role_name: '',
                color: '',
                permissions: [],
                options: [],
                current: [],
            }
        },
        components: {dropdown},
        methods: {
            setCurrent(v){
                this.current = v;
            },
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
            const data = await API.get('/api/permissions');

            let options = this.options;

            for (const key in data.data.message) {
                if (data.data.message.hasOwnProperty(key) && key.substring(0, 2) === "__") {
                    options.push({
                        value: key,
                        name: data.data.message[key]
                    });
                }
            }
            this.options = options;
        },
    }
</script>
