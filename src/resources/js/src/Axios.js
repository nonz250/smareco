import axios from 'axios';

class Axios {
  constructor(headers = {'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest'}) {
    this._headers = headers;
  }

  async send(method, url, params = null) {
    const config = {
      method: null,
      url: url,
      headers: this._headers,
      data: null,
      params: null,
    };

    switch (method.toLowerCase()) {
    case 'get':
      config.method = 'get';
      config.params = params;
      break;
    case 'post':
      config.method = 'post';
      config.data = params;
      break;
    case 'put':
    case 'delete':
      if (typeof params.append === 'function') {
        params.append('_method', method.toUpperCase());
      } else {
        params['_method'] = method.toUpperCase();
      }
      config.method = 'post';
      config.data = params;
      break;
    default:
      console.error('Unknown method.');
      throw 'Unknown method.';
    }

    const onSuccess = (res) => {
      return Promise.resolve(res);
    };

    const onError = (error) => {
      return error.response;
    };

    return await axios(config).then(onSuccess).catch(onError);
  }
}

export default Axios;
