<template>
    <div class="admin-item-display-holder">
        <input class="admin-item-title-input" :id="'name' + item.id" v-model="item.name" type="text" name="name"
               placeholder="Event name"/>

        <div class="form-line">
            <textarea class="admin-item-text-editor" :id="'description' + item.id" v-model="item.description" type="text" name="description"
                      placeholder="Event name"></textarea>
        </div>

    </div>
</template>

<script>
    export default {
        name: 'Item',
        props: ['item'],
        data() {
            return {

            }
        },
        methods: {

        },
    }
</script>

