import Api from '../../Api';

class SyncHistoryRepository extends Api {
  async findLatest() {
    const response = await this._api.send('get', '/api/sync_history');
    if (!this.checkErrorByResponseStatus(response)) {
      return false;
    }
    return response.data;
  }
}

export default SyncHistoryRepository;
