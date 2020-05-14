<template>
    <div>
        <input type="file" name="pdf" id="pdf" ref="pdf">
        <button class="button-create-item map-settings-container-items" v-on:click="submit">upload</button>
        <canvas id="theCanvas" ref="canvas"></canvas>
    </div>
</template>

<script>
    import API from "../../Api";
    import PDFJS from "pdfjs-dist"
    import {bytesToBase64} from "byte-base64";

    export default {
        data() {
            return {}
        },
        methods: {
            submit() {
                let numPages = 0;

                const fileReader = new FileReader();
                let file = this.$refs.pdf;
                file = file.files[0];
                let base64 = null;

                fileReader.onload = function () {
                    const typedArray = new Uint8Array(this.result);
                    base64 = bytesToBase64(typedArray);
                    PDFJS.getDocument(typedArray).then(function (pdf) {
                        numPages = pdf.numPages;
                        for (let i = 0; i <= numPages; i++) {
                            pdf.getPage(i).then(handlePages);
                        }
                    });
                    uploadBase64(base64);
                };

                const handlePages = function (page) {
                    let viewport = page.getViewport(1);
                    let canvas = document.createElement("canvas");
                    canvas.style.display = "block";
                    let context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    page.render({canvasContext: context, viewport: viewport});
                    document.body.appendChild(canvas);
                }
                const uploadBase64 = function (string){
                    console.log(string);
                    API.post({cv: string}, '/api/profile-cv');
                }

                fileReader.readAsArrayBuffer(file);
            },
        }
    }
</script>
