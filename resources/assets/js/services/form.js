const Errors = require('./errors');
// import flash from './flash';
class Form {

    /**
     * Create a new Form instance.
     *
     * @param {object} data
     */
    constructor(data) {
        this.success = false;
        this.originalData = data;

        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new Errors();
    }

    /**
     * Fetch all relevant data for the form.
     */
    data() {
        let data = {};

        for (let property in this.originalData) {
            data[property] = this[property];
        }

        return data;
    }

    /**
     * Reset the form fields.
     */
    reset() {
        for (let field in this.originalData) {
            this[field] = '';
        }

        this.errors.clear();
    }

    isDisabled() {
        if (this.errors.any()){
            return true;
        }
        return this.success === true;
    }

    /**
     * Submit the form.
     *
     * @param {string} url
     */
    submit(url) {
        axios.post(url, this.data())
            .then(response => {
                this.success = true;
                // flash.success(response.message);
            })
            .catch(error => {
                this.errors.record(error.response.data.errors);
            });
    }
}

module.exports = Form;
