class Errors {
    constructor() {
        this.errors = {}
    }

    record(errors) {
        this.errors = errors;
    }

    get(field) {
        if (this.errors[field]) {
            return this.errors[field][0];
        }
    }
    hasMessage(){
        return this.errors.hasOwnProperty('message')
    }
    getMessage(){
        return this.errors.message
    }
}
export default Errors;
