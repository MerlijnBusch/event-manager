<template>
    <form class="form" id="app" action="/" method="post" @submit.prevent="AccountVerification">
        <h2 class="form-title">
            Uw account moet nog geactiveerd worden!
        </h2>

        <div class="form-line form-loading" v-if="isLoading">
            <loading></loading>
        </div>

        <h5>
            In uw e-mail postvak vind u een bericht met een activatielink. Geen bericht ontvangen van ons? Vul dan hier uw emailadres in om de activatielink opnieuw te sturen naar uw emailadres.
        </h5>

        <div class="form-line">
            <label class="form-label" for="email">E-mail</label>
            <input class="form-text-input" v-model="email" type="email" name="email" required>
        </div>

        <div class="form-line form-line-hasbutton">
            <input type="submit" value="Login" class="form-button">
        </div>
    </form>
</template>
<script>

    import API from '../../Api';
    import loading from '@/js/components/loading';

    export default {
        data() {
            return {
                email: null,
                errors: [],
                isLoading: false
            }
        },
        components: { loading },
        methods: {
            async AccountVerification() {
                this.isLoading = true;

                axios.post("/api/email/resend", {
                    email: this.email
                }).then(response => {
                    this.isLoading = false;
                    alert("Activatielink opnieuw verzonden, bekijk het postvak van het opgegeven e-mailadres. ");
                    window.location.href = window.location.origin;
                }).catch(e => {
                    API.errorCheck(e);
                })

                
            }
        },
        mounted() {

        }
    }
</script>
