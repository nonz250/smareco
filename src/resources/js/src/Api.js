import Axios from './Axios';

class Api {
  set errors(value) {
    this._errors.push(value);
  }

  get errors() {
    return this._errors;
  }

  set exception(value) {
    this._exception = value;
  }

  get exception() {
    return this._exception;
  }

  constructor() {
    this._api = new Axios();
    this._errors = [];
  }

  checkErrorByResponseStatus(response) {
    this._errors = [];
    if (response.status >= 200 && response.status < 300) {
      return true;
    } else if (response.status === 422) {
      this.errors = response.data.errors;
      return false;
    } else {
      this.errors = [response.message];
      this.exception = response.message;
      return false;
    }
  }
}

export default Api;
