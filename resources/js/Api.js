import axios from 'axios';
import create from 'dom-create-element';

export default class API {

    constructor() {
        this.token = null
        this.headers = null
    }

    /**
     * @param token
     */
    static setToken(token){
        this.token = token;
        this.headers = {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        }
    }

    static errorCheck(data){
        const error = create({
            selector: 'div',
            styles: 'error-display',
            children: create({
                selector: 'p',
                html: data,
            })
        });

        document.getElementById("body").appendChild(error);

        setTimeout(() => {
            error.style.opacity = 0;
        }, 5000)

        setTimeout(() => {
            error.parentNode.removeChild(error);
        }, 7000)
    }

    /**
     * @param url
     * @returns {Promise<AxiosResponse<any>>}
     */
    static async get(url){
        try {
            return await axios.get(window.location.origin + url, {headers: this.headers});
        } catch (e) {
            this.errorCheck(e)
        }
    }

    /**
     * @param data
     * @param url
     * @param update
     * @returns {Promise<AxiosResponse<any>>}
     */
    static async post(data, url, update = false){
        try {
            if(update) return await axios.patch(window.location.origin + url, data, {headers: this.headers});
            return await axios.post(window.location.origin + url, data, {headers: this.headers});
        } catch (e) {
            this.errorCheck(e)
        }
    }

    /**
     * @param url
     * @returns {Promise<AxiosResponse<any>>}
     */
    static async delete(url){
        try {
            return await axios.delete(window.location.origin + url, {headers: this.headers});
        } catch (e) {
            this.errorCheck(e)
        }
    }
}


