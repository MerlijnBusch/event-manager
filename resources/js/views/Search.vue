<template>
    <div class="search">
        <label class="flex-wrapper search-label">
            <span class="search-label-text">Search:</span>
            <span class="search-input">
                <input  type="text" v-model="searchString">
                <select v-model="selectedRole">
                    <option value="">Alles</option>
                    <option v-for="role in roles">{{role}}</option>
                </select>
            </span>
        </label>
        <div class="search-results">

        </div>
    </div>
</template>

<script>
    export default {
        name: 'search',
        data() {
            return {
                searchString: '',
                newSearchString: '',
                oldSearchString: '',
                sendTimeout: null,
                selectedRole: '',
                //TODO: Get roles from DB
                roles: ['Bezoeker', 'StandHouder', 'Werkzoekende'],
            }
        },
        watch: {
            searchString() {
                this.send()
            }
        },
        methods: {
            send() {
                clearTimeout(this.sendTimeout);
                this.sendTimeout = setTimeout(() => {
                    this.newSearchString = this.searchString.trim();
                    if (this.newSearchString.length && this.newSearchString !== this.oldSearchString) {
                        this.oldSearchString = this.newSearchString;
                        //TODO: call here
                        console.log(this.newSearchString);
                    }
                }, 500);

            }
        }
    }
</script>

<style lang="scss">
    @import "../../sass/variables";

    .search {
        background: $dark-gray;
        flex: 1;
        .search-label{
            display: flex;
            flex-wrap: wrap;
            .search-label-text {
                flex: 1 0 100%;
                font-weight: bold;
                color: $basic-gray;
                font-size: $font-size-big;
            }
            .search-input{
                display: flex;
                flex: 1;
                margin-top: $padding-small;

                input{
                    flex: 1;
                    border-radius: $border-radius-small 0 0 $border-radius-small;
                    border: none;
                    padding: $padding-small;
                }
                select{
                    flex: 0 0 max-content;
                    border-radius: 0 $border-radius-small $border-radius-small 0;
                    padding: $padding-small;
                    border: none;
                    width: max-content;
                }
            }
        }
    }
</style>