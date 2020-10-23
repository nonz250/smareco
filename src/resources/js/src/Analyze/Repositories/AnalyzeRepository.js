import Api from '../../Api';

class AnalyzeRepository extends Api {
  async get() {
    const response = await this._api.send('get', '/api/analyze');
    if (!this.checkErrorByResponseStatus(response)) {
      return false;
    }
    return response.data;
  }
}

export default AnalyzeRepository;
