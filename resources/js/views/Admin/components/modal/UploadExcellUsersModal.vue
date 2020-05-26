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
                        <button class="button-create-item map-settings-container-items" v-on:click="submit">upload</button>

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
    //@todo excell to json converter upload to db
    import API from "../../../../Api";

    export default {
        data() {
            return {}
        },
        name: 'CreateBlockModal',
        props: ['id'],
        methods: {
            close() {
                this.$emit('close');
            },
            submit(){
                const reader = new FileReader();
                let file = this.$refs.excell;
                file = file.files[0];

                // reader.onload = function(e) {
                //     let data = e.target.result;
                //     let cfb = XLS.CFB.read(data, {type: 'binary'});
                //     let wb = XLS.parse_xlscfb(cfb);
                //     // Loop Over Each Sheet
                //     wb.SheetNames.forEach(function(sheetName) {
                //         // Obtain The Current Row As CSV
                //         var sCSV = XLS.utils.make_csv(wb.Sheets[sheetName]);
                //         var oJS = XLS.utils.sheet_to_row_object_array(wb.Sheets[sheetName]);
                //
                //         $("#my_file_output").html(sCSV);
                //         console.log(oJS)
                //     });
                // };

                // Tell JS To Start Reading The File.. You could delay this if desired
                // reader.readAsBinaryString(oFile);
            },
        },
    };
</script>

