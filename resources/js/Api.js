import axios from 'axios';

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

    /**
     * @param url
     * @returns {Promise<AxiosResponse<any>>}
     */
    static async get(url){
        return axios.get(window.location.origin + url, {headers: this.headers})
    }

    /**
     * @param data
     * @param url
     * @param update
     * @returns {Promise<AxiosResponse<any>>}
     */
    static async post(data, url, update = false){
        if(update) return axios.patch(window.location.origin + url, data, {headers: this.headers});
        return axios.post(window.location.origin + url, data, {headers: this.headers});
    }
}


