<template>
    <div>
        <h1>Dropdown example component</h1>
        <dropdown :options="options" :current="current" @setCurrent="(v)=>{current = v}"></dropdown>
    </div>
</template>
<script>
    import Dropdown from "./dropdown";
    export default {
        components: {Dropdown},
        data(){
            return{
                options: ['this','is','my','dropdown'],
                current: 'my', //can also be null
            }
        }
    }
</script>