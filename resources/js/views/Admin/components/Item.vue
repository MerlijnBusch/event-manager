<template>
    <div class="admin-item-display-holder">
        <input class="admin-item-title-input" id="name" v-model="item.name" type="text" name="name"
               placeholder="Event name"/>
        <quill
            @selection-change="selectionChange"
            ref="qlCon"
            class="admin-item-text-editor"
            output="html"
            v-model="item.description"
            :config="config"
        ></quill>
    </div>
</template>

<script>
    import {Config} from "../../../quillConfig";

    export default {
        name: 'Item',
        props: ['item'],
        data() {
            return {
                config: Config,
                isFocus: false,
            }
        },
        methods: {
            selectionChange(editor, range) {
                if (range === null && this.isFocus === false) {
                    this.$refs.qlCon.$el.children[0].style.display = "none";
                } else if(this.isFocus === true){
                    this.$refs.qlCon.$el.children[0].style.display = "block";
                }
            },
            focus(event){
                this.isFocus = true;
            },
            blur(event){
                this.isFocus = false;
            }
        },
        mounted() {
            this.focus = this.focus.bind(this);
            this.blur = this.blur.bind(this);

            this.$refs.qlCon.$el.addEventListener('focus', this.focus, true);
            this.$refs.qlCon.$el.addEventListener('blur', this.blur, true);
        },
        beforeDestroy() {
            this.$refs.qlCon.$el.removeEventListener('focus', this.focus, true);
            this.$refs.qlCon.$el.removeEventListener('blur', this.blur, true);
        }
    }
</script>

<style>
    .admin-item-display-holder {
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .admin-item-text-editor {
        margin-top: 8px;
        display: flex;
        flex: 1;
        flex-direction: column-reverse;
    }

    .admin-item-display-holder .ql-toolbar.ql-snow {
        border: unset;
        display: none;
        position: relative;
    }

    .admin-item-display-holder .ql-container.ql-snow {
        border: unset;
    }

    .admin-item-display-holder .ql-editor {
        min-height: 100px;
        max-height: 200px;
        padding: 0;
    }

    .admin-item-title-input {
        background: transparent;
        outline: transparent;
        border: transparent;
        width: 100%;
        font-size: x-large;
    }

    .admin-item-title-input:focus {
        border-bottom: 2px solid lightblue;
    }
</style>
