import CustomerRepository from '../Repositories/CustomerRepository';

class GetCustomers {
  constructor() {
    this._customerRepository = new CustomerRepository();
  }

  async process(input) {
    const result = await this._customerRepository.findForPaginate(
      input.name,
      input.store_id,
      input.page,
      input.length,
      input.order,
      input.order_key,
    );
    if (result === false) {
      throw this._customerRepository.error;
    }
    return result;
  }
}

export default GetCustomers;
