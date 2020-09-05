import Api from '../../Api';

class SyncNecessaryRepository extends Api {
  async findLatest() {
    const response = await this._api.send('get', '/api/sync_necessary');
    if (!this.checkErrorByResponseStatus(response)) {
      return false;
    }
    return response.data;
  }
}

export default SyncNecessaryRepository;
