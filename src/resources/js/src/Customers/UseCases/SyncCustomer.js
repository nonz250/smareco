import CustomerRepository from '../Repositories/CustomerRepository';

class SyncCustomer {
  constructor() {
    this._customerRepository = new CustomerRepository();
  }
  async process() {
    const result = await this._customerRepository.sync();
    if (result === false) {
      throw this._customerRepository.error;
    }
    return result;
  }
}

export default SyncCustomer;
