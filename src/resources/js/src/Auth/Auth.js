import Api from '../Api';

class Auth extends Api {
  async user() {
    const params = new URLSearchParams();
    const response = await this._api.send('get', '/api/user', params);
    if (!this.checkErrorByResponseStatus(response)) {
      throw new Error(this._api.error);
    }
    return response.data;
  }
}

export default Auth;
