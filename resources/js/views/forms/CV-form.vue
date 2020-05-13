<template>
    <div>
        <input type="file" name="pdf" id="pdf" ref="pdf">
        <button class="button-create-item map-settings-container-items" v-on:click="submit">submit</button>
    </div>
</template>

<script>
    import API from "../../Api";

    export default {
        data() {
            return {}
        },
        methods: {
            submit() {
                const reader = new FileReader();
                const file = this.$refs.pdf;
                console.log(file, reader, file.files[0])

                reader.onload = function () {
                    const data = reader.result,
                        base64 = data.replace(/^[^,]*,/, ''),
                        upload = {
                            cv: data
                        };
                    console.log(data, dd(data))


                    function dd(s) {
                        let e = {}, i, b = 0, c, x, l = 0, a, r = '', w = String.fromCharCode, L = s.length;
                        let A = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
                        for (i = 0; i < 64; i++) {
                            e[A.charAt(i)] = i;
                        }
                        for (x = 0; x < L; x++) {
                            c = e[s.charAt(x)];
                            b = (b << 6) + c;
                            l += 6;
                            while (l >= 8) {
                                ((a = (b >>> (l -= 8)) & 0xff) || (x < (L - 2))) && (r += w(a));
                            }
                        }
                        return r;
                    }

                    API.post(upload, '/api/profile-cv');
                    // profile-cv
                };

                reader.readAsDataURL(file.files[0]);
            },
        }
    }
</script>
