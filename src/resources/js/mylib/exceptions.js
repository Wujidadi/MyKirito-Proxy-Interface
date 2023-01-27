class BasicException {
    constructor(code = 1, message = 'error', data = {}) {
        this.code = code;
        this.message = message;
        this.data = data;
    }
}

class FormException extends BasicException {}

export default {
    FormException,
};
