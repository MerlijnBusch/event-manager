<template>
    <transition name="modal-fade">
        <div class="admin-modal-backdrop">
            <div class="admin-modal"
                 role="dialog"
                 aria-labelledby="modalTitle"
                 aria-describedby="modalDescription"
            >
                <header
                    class="admin-modal-header"
                    id="modalTitle"
                >
                    <slot name="header">
                        <p
                            class="admin-modal-title"
                        >
                            Update Block
                        </p>

                        <button
                            type="button"
                            class="admin-modal-btn-close"
                            @click="close"
                            aria-label="Close modal"
                        >
                            x
                        </button>
                    </slot>
                </header>
                <section
                    class="admin-modal-body"
                    id="modalDescription"
                >
                    <slot name="body">

                        <input type="file" id="my_file_input" ref="excell"/>
                        <button class="button-create-item map-settings-container-items" v-on:click="parseFileInPut">upload</button>

                    </slot>
                </section>
                <footer class="admin-modal-footer">
                    <slot name="footer">
                        <button
                            type="button"
                            class="admin-modal-btn-green"
                            @click="close"
                            aria-label="Close modal"
                        >
                            Close
                        </button>
                    </slot>
                </footer>
            </div>
        </div>
    </transition>
</template>

<script>
    import API from "../../../../Api";

    export default {
        data() {
            return {}
        },
        name: 'UploadExcelUserModal',
        methods: {
            close() {
                this.$emit('close');
            },
            parseFileInPut(){
                const parseExcel = function(file) {
                    let reader = new FileReader();
                    let array = [];

                    reader.onload = function(e) {
                        let data = e.target.result;
                        let workbook = XLSX.read(data, {
                            type: 'binary'
                        });

                        workbook.SheetNames.forEach(function(sheetName) {
                            array = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                        })

                        const postData = JSON.stringify(array);
                        API.post(postData, '/api/admin/excel');

                    };

                    reader.onerror = function(ex) {
                        console.log(ex);
                    };

                    reader.readAsBinaryString(file);
                };

                let file = this.$refs.excell;
                file = file.files[0];
                parseExcel(file);
            },
        },
    };
</script>

