<template>
    <div class="profile-container flex-grid column-desktop-full">
      <div class="column-desktop-full column-tablet-12 column-mobile-12 profile-top">
        <h1>{{$user.data.name}}'s profiel</h1>
      </div>
      <form autocomplete="off" @submit.prevent="editProfile" method="post">
        <div class="mobile-wrapper flex-grid column-desktop-full">
            <div class="column-desktop-4 column-tablet-6 column-mobile-12 profile-border profile-main-wrapper">
            <p class="profile-edit" :class="{'profile-save-padding': edit}"><a href="#" @click="edit = !edit" id="disableLink"><span>Profiel aanpassen </span><i class="fas fa-cog"></i></a></p>
            <input type="submit" :class="{'profile-save': edit, 'invis': !edit}" v-if=" edit"  value="Profiel opslaan">
            <div class="profile-foto">

            </div>
            <input type="file" name="image" ref="image" @change="onFileChange" >
            <div class="profile-main">
                <p class="profile-name">{{$user.data.name}}</p>
                <p class="profile-role">{{role_name}}</p>
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
                <p class="contact-logo"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 8c0 .557-.447 1.008-1 1.008s-1-.45-1-1.008c0-.557.447-1.008 1-1.008s1 .452 1 1.008zm0 2h-2v6h2v-6zm3 0h-2v6h2v-2.861c0-1.722 2.002-1.881 2.002 0v2.861h1.998v-3.359c0-3.284-3.128-3.164-4-1.548v-1.093z"/></svg></p>
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
        data(){
             return{
               data: {},
               role_name: null,
               about: null,
                contact: null,
                edit: false,
                image: null,
             }
            document.getElementById("disableLink").addEventListener("click", function (event) {
                event.preventDefault()
            });
        },async mounted(){
            const data = await API.get("/api/profile-check")
            console.log(data);
          if( data.data[0] ){
          this.data = data.data[0];
          this.about = this.data.profile.about;
          this.role_name = this.data.role.role_name;
          this.contact = this.data.contact;
          }
         
        },
        methods:{
            editProfile(){
                const file = this.image;
            console.log(reader.readAsDataURL(file));
            // API.post('/api/profile/').then(result=>{
            //     this.file = reader.readAsDataURL(file);
            // }) 
            },
            onFileChange(e) {
                    var files = e.target.files || e.dataTransfer.files;
                    var test = [files];
                    if (!files.length)
                        return;
                    test.forEach(file => {
                        const reader = new FileReader();
                        var image = reader.readAsDataURL(file);
                    });
                    console.log(image);
                }
        }

    }
    


</script>

<style>

</style>
