import axios from 'axios';

const post = async function(token, data, url){

    const headers = {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + token
    }

    let resData = {}
    await axios.post(window.location.origin + url, data, {headers: headers}).then(response => {
        resData = response;
    }).catch(e => {
        resData = e;
    })

    return resData;
}

const get = async function(token, url){

    const headers = {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + token
    }

    let resData = {}
    await axios.get(window.location.origin + url, {headers: headers}).then(response => {
        console.log(response);
        resData = response;
    }).catch(e => {
        resData = e;
    })

    return resData;
}

const functions = {get, post};
export default functions;


