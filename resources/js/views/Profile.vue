<template>
    <div class="profile-container flex-grid column-desktop-full">
        <div class="column-desktop-full column-tablet-12 column-mobile-12 profile-top">
            <h1>{{$user.data.name}}'s profiel</h1>
        </div>
        <div class="mobile-wrapper flex-grid column-desktop-full">
            <div class="column-desktop-4 column-tablet-6 column-mobile-12 profile-border profile-main-wrapper">
                <p class="profile-edit"><a href="#"><span>Profiel aanpassen </span><i class="fas fa-cog"></i></a></p><br>
                <div class="profile-main">
                    <img src="https://via.placeholder.com/280px" alt="Profiel foto" class="profile-foto">
                    <p class="profile-name">{{$user.data.name}}</p>
                    <p class="profile-role">{{role_name}}</p>
                </div>
            </div>
            <hr class="profile-line-phone">
            <div class="column-desktop-8 column-tablet-6 column-mobile-12 profile-about-mobile">
                <div class="profile-border profile-about">
                    <div class="profile-about-border">
                        <p class="profile-about-title">About</p>
                        <p class="profile-about-description">{{about}}</p>
                    </div>
                </div>
                <div class="profile-border profile-contact profile-border">
                    <p class="contact-title">Contact</p>
                    <p class="contact-logo"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 8c0 .557-.447 1.008-1 1.008s-1-.45-1-1.008c0-.557.447-1.008 1-1.008s1 .452 1 1.008zm0 2h-2v6h2v-6zm3 0h-2v6h2v-2.861c0-1.722 2.002-1.881 2.002 0v2.861h1.998v-3.359c0-3.284-3.128-3.164-4-1.548v-1.093z"/></svg></p>
                </div>
            </div>
        </div>
    </div>
</template>


<script>

    // import API from '@/js/Api';

    export default {
        name: "Profile",
        data(){
            return{
                role_name: "Administrator",
                about: "Ik ben een administator van Nederlandse zaken als er vragen zijn kan je die altijd aan mij stellen.",
            }
        }
        //       return{
        //         data: {},
        //         role_name: null,
        //         about: null,
        //         contact: null,
        //       }

        //  },async mounted(){
        //    const data = await API.get("/api/profile")
        //    if( data.data[0] ){
        //    this.data = data.data[0];
        //    this.about = this.data.about;
        //    this.contact = this.data.contact;
        //    }
        //    const dataRole = await API.get("/api/role-display")
        //    this.role_name = dataRole.data[0];
        //  }

    }


</script>

<style>
    div.profile-container{
        background-color: #404040;
    }
    .navbar{z-index: 1;}

    @media (min-width: 980px) {
        .profile-border{
            border-radius: 15px;
            box-shadow: 2px 0px 24px -8px black;
        }
        .profile-top h1{
            color: #c1c1c1;
            font-weight: bold;
            font-size: 60px;
            padding: 50px 90px;
            margin: 0;
        }
        .profile-main-wrapper{
            background-color: #1F1F1F;
            color: #C1C1C1;
            height: 781px;
        }
        .profile-main{
            margin: 0 auto;
            margin-top: 100px;
            width: 50%;
            text-align: center;
        }
        .profile-about{
            background-color: #767676;
            height: 514px;
            padding: 100px;
        }
        div.profile-contact{
            background-color: #c1c1c1;
            height: 267px;
            padding: 42px 140px ;
        }
        .contact-title{
            font-size: 50px;
            font-weight: bold;
            line-height: 8px;
            letter-spacing: 1px;
        }
        .profile-foto{
            border: solid #9A9595 8px;
            border-radius: 150px;
            width: 288px;
            height: 288px;
        }
        .profile-name{
            margin-top: 66px;
            margin-bottom: 0;
            text-align: left;
            font-size: 40px;
            line-height: 69px;
            letter-spacing: 1px;
            font-weight: bold;
        }
        .profile-role{
            text-align: left;
            margin-top: 0;
            font-size: 25px ;
            font-weight: bold;
        }
        .profile-edit{
            text-align: right;
            margin: 16px 22px 0 0;
        }
        .profile-edit a{
            color: #C1C1C1;
            font-weight: bold;
            text-decoration: none;
            font-size: 20px;
        }
        .profile-about-border{
            padding-left: 20px;
            position: relative;


        }
        .profile-about-border:after{
            content: "";
            position: absolute;
            width: 14px;
            height: 100%;
            left: 0;
            top: 0;
            background-color: #404040;
            border-radius: 7px;
        }
        .profile-about-title{
            font-weight: bold;
            font-size:50px;
            margin: 0;
        }
        .profile-about-description{
            font-size: 15px;
            width: 404px;
        }
        .profile-line-phone{
            display: none;
            visibility: hidden;
        }
        .contact-logo svg{
            fill: #1F1F1F;
            width: 40px;
            height: 40px;
            padding-top: 10px;
        }
    }
    @media (max-width: 660px) {
        body{color: #C1C1C1;}
        .mobile-wrapper{
            background-color: #1F1F1F;
            color: #C1C1C1;
            text-align: center;
            border: 0px solid black;
            border-radius: 35px;
            height: 654px;
        }
        .profile-edit a,.profile-edit{
            color: #C1C1C1;
            font-weight: bold;
            text-decoration: none;
            text-align: right;
            padding-right: 15px;
        }
        .profile-edit a span, .profile-about-title{
            visibility: hidden;
            display: none;
        }
        .profile-foto{
            border: solid #9A9595 4px;
            border-radius: 150px;
            width: 106px;
            height: 106px;
        }
        .navbar-user{
            left: 0;
        }
        .profile-name{
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 0;
        }
        .profile-role{
            font-weight: bold;
            font-size: 16px;
            margin-top: 5px;
        }
        .profile-about-description{
            width: 253px;
            text-align: left;
            margin: 0 auto;
            font-size: 15px;
        }
        .profile-line-phone{
            width: 247px;
            height: 0;
            color: #404040;
        }
        .contact-title{
            padding-top: 40px;
            width: 253px;
            text-align: left;
            margin: 0 auto;
            font-size: 25px;
            font-weight: bold;
        }
        .contact-logo{
            width: 253px;
            text-align: left;
            margin: 0 auto;
        }
        .contact-logo svg{
            fill: #C1C1C1;
            width: 40px;
            height: 40px;
            padding-top: 10px;
        }
        .profile-main-wrapper{
            margin-bottom: -200px;
        }
        .profile-about-mobile{
            margin-top: -170px !important;
        }
        .profile-top{
            font-size: 15px;
            font-weight: bold;
            padding-left: 25px;
        }
    }
</style>