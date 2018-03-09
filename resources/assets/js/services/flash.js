import Vuew from 'vue';

class Flash {

    constructor(){
        this.events = new Vue();
    }

    success(message) {
        this.events.$emit('flash', message, 'success');
    }

    warning(message) {
        this.events.$emit('flash', message, 'warning');
    }
}

export default new Flash;
