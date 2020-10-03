import Api from '../../Api';

class AnalyzeTransaction extends Api{
  async process() {
    const response = await this._api.send('post', '/api/analyze');
    if (!this.checkErrorByResponseStatus(response)) {
      throw this.error;
    }
    return response.data;
  }
}

export default AnalyzeTransaction;
