import Api from '../../Api';

class CustomerRepository extends Api {
  async sync() {
    const response = await this._api.send('post', '/api/customer/sync');
    if (!this.checkErrorByResponseStatus(response)) {
      return false;
    }
    return response.data;
  }
}

export default CustomerRepository;
