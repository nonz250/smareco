import Api from '../../Api';

class CustomerRepository extends Api {
  async sync() {
    const response = await this._api.send('post', '/api/customer/sync');
    if (!this.checkErrorByResponseStatus(response)) {
      return false;
    }
    return response.data;
  }

  async findForPaginate(name, storeId, page, length, order, orderKey) {
    const params = new URLSearchParams();
    if (name) {
      params.append('name', name);
    }
    if (storeId) {
      params.append('store_id', storeId);
    }
    if (page) {
      params.append('page', page);
    }
    if (length) {
      params.append('length', length);
    }
    if (order) {
      params.append('order', order);
    }
    if (orderKey) {
      params.append('order_key', orderKey);
    }
    const response = await this._api.send('get', '/api/customer', params);
    if (!this.checkErrorByResponseStatus(response)) {
      return false;
    }
    return response.data;
  }
}

export default CustomerRepository;
