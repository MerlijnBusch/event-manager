<template>
    <div class="profile-container">
        <div class="flex-wrapper profile-top">
            <h1>{{name}}'s profiel</h1>
        </div>
        <form autocomplete="off" @submit.prevent="editProfile" method="post" class="form-profile-edit">
            <div class="mobile-wrapper flex-grid column-desktop-full">
                <div class="column-desktop-4 column-tablet-6 column-mobile-12 profile-border profile-main-wrapper">
                    <p class="profile-edit" :class="{'profile-save-padding': edit}"><a href="#" @click="edit = !edit"
                                                                                       id="disableLink"><span>Profiel aanpassen </span><i
                            class="fas fa-cog"></i></a></p>
                    <input type="submit" :class="{'profile-save': edit, 'invis': !edit}" v-if=" edit"
                           value="Profiel opslaan">
                    <div class="profile-foto" :style="!!image ? {backgroundImage: 'url('+image+')'} : ''">

                    </div>
                    <input type="file" name="image" @change="onFileChange">
                    <div class="profile-main">
                        <p class="profile-name" v-if="!edit">{{name}}</p>
                        <input type="text" v-model="name" class="profile-name" v-else>
                        <select class="form-text-input" v-model="role_name" v-else>
                            <option v-for="userrole in roles" :value="userrole.id">{{userrole.role_name}}</option>
                        </select>
                    </div>
                </div>
                <hr class="profile-line-phone">
                <div class="column-desktop-8 column-tablet-6 column-mobile-12 profile-about-mobile">
                    <div class="profile-border profile-about">
                        <div class="profile-about-border">
                            <p class="profile-about-title">Vertel over jezelf</p>
                            <p class="profile-about-description" v-if="!edit">{{about}}</p>
                            <textarea v-model="about" class="profile-about-description" v-else></textarea>
                        </div>
                    </div>
                    <div class="profile-border profile-contact profile-border">
                        <p class="contact-title">Contact</p>
                        <p class="contact-logo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 8c0 .557-.447 1.008-1 1.008s-1-.45-1-1.008c0-.557.447-1.008 1-1.008s1 .452 1 1.008zm0 2h-2v6h2v-6zm3 0h-2v6h2v-2.861c0-1.722 2.002-1.881 2.002 0v2.861h1.998v-3.359c0-3.284-3.128-3.164-4-1.548v-1.093z"/>
                            </svg>
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>


<script>

    import API from '../Api';

    export default {
        name: "Profile",
        data() {
            return {
                name: null,
                data: {},
                roles: [],
                role_name: null,
                about: null,
                facebook: null,
                twitter: null,
                linkedin: null,
                phonenumber: null,
                contact_email: null,
                edit: false,
                image: null,
            }
            document.getElementById("disableLink").addEventListener("click", function (event) {
                event.preventDefault()
            });
        }, async mounted() {
            const res = await API.get("/api/profile-check");

            if (!res.data) return

            const data = res.data;

            if (data.name) {
                this.name = data.name;
            }

            if (data.profile) {
                this.about = data.profile.about;
                this.image = data.profile.image;
            }

            if (data.role) {
                this.role_name = data.role.role_name;
            }

            const roles = await API.get("/api/selectable-roles")
            if (!roles.data) return this.roles = "Er zijn geen selecteerbare rollen.";

            this.roles = roles.data;

        },
        methods: {
            async onFileChange(e) {
                let base64;
                const file = e.target.files[0];
                const reader = new FileReader();
                const imageTypes = ["png", "jpeg"];

                if (!imageTypes.includes(file.type.split('/')[1])) {
                    e.target.value = null;
                    this.image = null;
                    alert('Verkeerde image type toegestaan [png, jpeg]');
                    return;
                }

                reader.onload = function () {

                    base64 = this.result

                };

                await reader.readAsDataURL(file);

                this.image = base64;
            },
            async editProfile() {
                const data = {
                    about: this.about,
                    contact: this.contact,
                    image: this.image

                };
                await API.post(data, '/api/profile-edit');
                await API.post(this.role_name, '/api/role/' + this.user_id)
            }

        }

    }


</script>
