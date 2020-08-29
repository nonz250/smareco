import Axios from './Axios';

class Api {
  get error() {
    return this._error;
  }

  set errors(value) {
    this._error.errors = value;
  }

  set exception(value) {
    this._error.exception = value;
  }

  constructor() {
    this._api = new Axios();
    this._error = new Error();
    this._error.errors = [];
  }

  checkErrorByResponseStatus(response) {
    this._error = new Error();
    this._error.errors = [];
    if (response.status >= 200 && response.status < 300) {
      return true;
    } else if (response.status === 422) {
      this.errors = response.data.errors;
      return false;
    } else {
      this.errors = [response.data.message];
      this.exception = response.data.message;
      return false;
    }
  }
}

export default Api;
