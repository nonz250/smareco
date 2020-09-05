import SyncNecessaryRepository from '../Repositories/SyncNecessaryRepository';

class GetSyncNecessary {
  constructor() {
    this._syncNecessaryRepository = new SyncNecessaryRepository();
  }

  async process() {
    const result = await this._syncNecessaryRepository.findLatest();
    if (result === false) {
      throw this._syncNecessaryRepository.error;
    }
    return result;
  }
}

export default GetSyncNecessary;
