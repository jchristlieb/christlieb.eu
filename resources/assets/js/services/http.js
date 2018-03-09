import axios from 'axios';

class Http {
    constructor() {
        let service = axios.create({
            headers: {csrf: 'token'}
        });
        service.interceptors.response.use(this.handleSuccess, this.handleError);
        this.service = service;
    }

    handleSuccess(response) {
        return response;
    }

    handleError = (error) => {
        return error
    }
    

    get(path, callback) {
        return this.service.get(path).then(
            (response) => callback(response.status, response.data)
        );
    }

    patch(path, payload, callback) {
        return this.service.request({
            method: 'PATCH',
            url: path,
            responseType: 'json',
            data: payload
        }).then((response) => callback(response.status, response.data));
    }

    post(path, payload, callback) {
        return this.service.request({
            method: 'POST',
            url: path,
            responseType: 'json',
            data: payload
        }).then((response) => callback(response.status, response.data));
    }
}

export default new Http;
