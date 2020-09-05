import SyncHistoryRepository from '../Repositories/SyncHistoryRepository';

class GetSyncHistory {
  constructor() {
    this._syncHistoryRepository = new SyncHistoryRepository();
  }

  async process() {
    const result = await this._syncHistoryRepository.findLatest();
    if (result === false) {
      throw this._syncHistoryRepository.error;
    }
    return result;
  }
}

export default GetSyncHistory;
