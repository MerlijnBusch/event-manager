import axios from 'axios';

export default class API {

    constructor() {
        this.token = null
        this.headers = null
    }

    static setToken(token){
        this.token = token;
        this.headers = {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + this.token
        }
    }

    static async get(url){
        return axios.get(window.location.origin + url, {headers: this.headers})
    }

    static async post(data, url){
        return axios.post(window.location.origin + url, data, {headers: this.headers})
    }
}


