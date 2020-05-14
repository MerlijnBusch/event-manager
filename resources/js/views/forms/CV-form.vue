<template>
    <div>
        <input type="file" name="pdf" id="pdf" ref="pdf">
        <button class="button-create-item map-settings-container-items" v-on:click="submit">submit</button>
        <canvas id="theCanvas"></canvas>
    </div>
</template>

<script>
    import API from "../../Api";
    import pdfjsLib from "pdfjs-dist"

    export default {
        data() {
            return {}
        },
        methods: {
            submit() {
                const reader = new FileReader();
                const file = this.$refs.pdf;
                console.log(file, reader, file.files[0])
                console.log(pdf);
                reader.onload = function () {
                    const data = reader.result,
                        base64 = data.replace(/^[^,]*,/, ''),
                        upload = {
                            cv: base64
                        };

                    // let loadingTask = pdfjsLib.getDocument(file.files[0]);
                    // loadingTask.promise
                    //     .then(function (pdfDocument) {
                    //         console.log(pdfDocument)
                    //         // Request a first page
                    //         return pdfDocument.getPage(1).then(function (pdfPage) {
                    //             console.log(pdfPage);
                    //             // Display page on the existing canvas with 100% scale.
                    //             let viewport = pdfPage.getViewport({ scale: 1.0 });
                    //             let canvas = document.getElementById("theCanvas");
                    //             canvas.width = viewport.width;
                    //             canvas.height = viewport.height;
                    //             let ctx = canvas.getContext("2d");
                    //             let renderTask = pdfPage.render({
                    //                 canvasContext: ctx,
                    //                 viewport: viewport,
                    //             });
                    //             return renderTask.promise;
                    //         });
                    //     })
                    //     .catch(function (reason) {
                    //         console.error("Error: " + reason);
                    //     });

                    API.post(upload, '/api/profile-cv');
                    // profile-cv
                };

                reader.readAsDataURL(file.files[0]);
            },
        }
    }
</script>
