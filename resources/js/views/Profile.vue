<template>
    <div class="profile-container">
        <div class="flex-wrapper profile-top">
            <h1>{{ name }}'s profiel</h1>
        </div>
        <form autocomplete="off" @submit.prevent="editProfile" method="post" class="form-profile-edit">
            <div class="mobile-wrapper flex-grid column-desktop-full column-tablet-12">
                <div class="column-desktop-4 column-tablet-12 column-mobile-12 profile-border profile-main-wrapper">
                    <p class="profile-edit" :class="{'profile-save-padding': edit}"><a href="#" @click.prevent="edit = !edit"
                        id="disableLink"><span>Profiel aanpassen </span><i
                        class="fas fa-cog"></i></a></p>
                    <input type="submit" :class="{'profile-save': edit, 'invis': !edit}" v-if=" edit"
                           value="Profiel opslaan" >
                    <div class="profile-foto" :style="!!image ? {backgroundImage: 'url('+image+')'} : ''">

                    </div>
                    <input type="file" name="image" @change="onFileChange" v-if="edit" class="profile-photo-input">
                    <div class="profile-main">
                        <p class="profile-name" v-if="!edit">{{name}}</p>
                        <input type="text" v-model="name" class="profile-name-edit" v-else>
                        <p class="profile-role" v-if="!edit">{{role_name}}</p>
                        <select class="form-text-input" v-model="role_name" v-else>
                            <option :value="roles.id" selected disabled>Uw rol is {{role_name}}</option>
                            <option v-for="userrole in roles" :value="userrole.id">{{userrole.role_name}}</option>
                        </select>
                        <div v-if="company && !edit">
                            <p class="profile-company" >Bedrijf</p>
                            <p class="profile-company-name" >{{company}}</p>
                        </div>
                        <div v-if="edit">
                            <p class="profile-company">Bedrijf</p>
                            <input type="text" v-model="company" class="profile-name-edit" >
                        </div>
                        <hr class="profile-line-phone" v-if="!edit">
                        <button class="download-cv" type="button" onclick="console.log('hoi')" v-else-if="!edit && cv">Download CV</button>
                        <input type="file" name="cv"  v-if="edit" class="profile-cv-input">
                    </div>
                </div>
                <div class="column-desktop-8 column-tablet-12 column-mobile-12 profile-about-mobile profile-row-right">
                    <div class="profile-border profile-about">
                        <div class="profile-about-border">
                            <p class="profile-about-title">
                                Vertel over jezelf
                            </p>
                            <p
                                v-if="!edit"
                                class="profile-about-description"
                            >
                                {{ about }}
                            </p>
                            <textarea
                                v-else
                                v-model="about"
                                class="profile-about-description"
                            />
                        </div>
                    </div>
                    <div class="profile-border profile-contact profile-border">
                        <p class="contact-title">Contact</p>
                        <div class="contact-logo" :class="{'contact-logo-edit' : edit}">
                            <div>
                            <a :href="linkedin" v-if="!edit && linkedin || edit" target="_blank">    
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 8c0 .557-.447 1.008-1 1.008s-1-.45-1-1.008c0-.557.447-1.008 1-1.008s1 .452 1 1.008zm0 2h-2v6h2v-6zm3 0h-2v6h2v-2.861c0-1.722 2.002-1.881 2.002 0v2.861h1.998v-3.359c0-3.284-3.128-3.164-4-1.548v-1.093z"
                                    />
                                </svg>
                            </a>
                            <input type="url" v-model="linkedin" class="contact-input" v-if="edit" placeholder="https://www.linkedin.com/">
                            </div>
                            <div>
                            <a :href="facebook" v-if="!edit && facebook || edit">    
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path 
                                        d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 10h-2v2h2v6h3v-6h1.82l.18-2h-2v-.833c0-.478.096-.667.558-.667h1.442v-2.5h-2.404c-1.798 0-2.596.792-2.596 2.308v1.692z"/>
                                </svg>
                            </a>
                            <input type="url" v-model="facebook" class="contact-input" v-if="edit" placeholder="https://www.facebook.com/">
                            </div>
                            <div>
                            <a :href="twitter" v-if="!edit && twitter || edit">    
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path 
                                        d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6.5 8.778c-.441.196-.916.328-1.414.388.509-.305.898-.787 1.083-1.362-.476.282-1.003.487-1.564.597-.448-.479-1.089-.778-1.796-.778-1.59 0-2.758 1.483-2.399 3.023-2.045-.103-3.86-1.083-5.074-2.572-.645 1.106-.334 2.554.762 3.287-.403-.013-.782-.124-1.114-.308-.027 1.14.791 2.207 1.975 2.445-.346.094-.726.116-1.112.042.313.978 1.224 1.689 2.3 1.709-1.037.812-2.34 1.175-3.647 1.021 1.09.699 2.383 1.106 3.773 1.106 4.572 0 7.154-3.861 6.998-7.324.482-.346.899-.78 1.229-1.274z"/>
                                </svg>
                            </a>
                            <input type="url" v-model="twitter" class="contact-input" v-if="edit" placeholder="https://twitter.com/">
                            </div>
                            <div>
                            <a :href="contact_email" v-if="!edit && contact_email || edit">    
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path 
                                        d="M12 2.02c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 12.55l-5.992-4.57h11.983l-5.991 4.57zm0 1.288l-6-4.629v6.771h12v-6.771l-6 4.629z"/>
                                </svg>
                            </a>
                            <input type="email" v-model="contact_email" class="contact-input" v-if="edit" placeholder="henk@email.nl">
                            </div>
                            <div>
                            <a :href="phonenumber" v-if="!edit && phonenumber || edit">    
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path 
                                        d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.5 17.311l-1.76-3.397-1.032.505c-1.12.543-3.4-3.91-2.305-4.497l1.042-.513-1.747-3.409-1.053.52c-3.601 1.877 2.117 12.991 5.8 11.308l1.055-.517z"/>
                                </svg>
                            </a>
                            <input type="text" v-model="phonenumber" class="contact-input" v-if="edit" placeholder="+31 6 1234567">
                            </div>
                        </div>
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
                company: null,
                cv: null,
            }
        },
        async mounted() {
            const res = await API.get("/api/profile-check");

            if (!res.data) return

            const data = res.data;

            if (data.name) {
                this.name = data.name;
            }

            if (data.profile) {
                this.about = data.profile.about;
                this.image = data.profile.image;
                this.facebook = data.profile.facebook;
                this.twitter = data.profile.twitter;
                this.linkedin = data.profile.linkedin;
                this.phonenumber = data.profile.phonenumber;
                this.contact_email = data.profile.contact_email;
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
                const imgData = this;
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
                    imgData.image = this.result;
                };
               
                await reader.readAsDataURL(file);
               
            },
            async editProfile() {
                const data = {
                    about: this.about,
                    image: this.image,
                    facebook: this.facebook,
                    twitter: this.twitter,
                    linkedin: this.linkedin,
                    phonenumber: this.phonenumber,
                    contact_email: this.contact_email
                };

                this.edit = false;

                await API.post(data, '/api/profile-edit', true);
                if (this.role_name) {
                    await API.post(this.role_name, '/api/selectable-role-edit', true);
                }
                
            }
        }
    }
</script>