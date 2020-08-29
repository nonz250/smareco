<?php
declare(strict_types=1);

namespace App\Http\Requests\Customers;

use App\Traits\GetSmaregiUserInfoTrait;
use Illuminate\Foundation\Http\FormRequest;
use Smareco\Customers\Command\UseCases\SyncCustomers\SyncCustomersInputPort;
use Smareco\Shared\Models\ValueObjects\AccessToken;

class SyncCustomerRequest extends FormRequest implements SyncCustomersInputPort
{
    use GetSmaregiUserInfoTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function tokenType(): string
    {
        return $this->getSmaregiUserInfoSession()->getSmaregiToken()->tokenType();
    }

    public function accessToken(): AccessToken
    {
        return $this->getSmaregiUserInfoSession()->getSmaregiToken()->accessToken();
    }

    public function contractId(): string
    {
        return $this->getSmaregiUserInfoSession()->getSmaregiUserInfo()->contractId();
    }
}
