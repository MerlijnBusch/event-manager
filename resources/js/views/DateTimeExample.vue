<template>
    <div>
        <h1>datePicker example component</h1>
        {{dateString}}
        <datePicker v-model="dateString" @change="$forceupdate"></datePicker>
    </div>
</template>
<script>
    import datePicker from "@/js/components/datePicker";
    export default {
        components: {datePicker},
        data(){
            return{
                dateString: '2020-06-01 09:15:00',
            }
        }
    }
</script>