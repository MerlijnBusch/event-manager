<template>
    <div class="search">
        <label>
            Search:
            <input type="text" v-model="searchString">
            <p>{{searchString}}</p>
        </label>
    </div>
</template>

<script>
    export default {
        name: 'search',
        data(){
            return{
                searchString: '',
                oldSearchString: '',
                sendTimeout: null,
            }
        },
        watch:{
          searchString(){
              this.send()
            }
        },
        methods: {
            send(){
                if (this.searchString.length && this.searchString !== this.oldSearchString){
                    this.oldSearchString = this.searchString;
                    clearTimeout(this.sendTimeout);
                    this.sendTimeout = setTimeout(()=>{
                        //TODO: call here
                        console.log(this.searchString);
                    },500);

                }
            }
        }
    }
</script>

<style lang="scss">
    @import "../../sass/variables";

    .search{
        background: $dark-gray;
        flex: 1;
    }
</style>