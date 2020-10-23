<?php
declare(strict_types=1);

namespace App\Http\Requests\Customers;

use App\Traits\GetProviderTrait;
use App\Traits\GetSmaregiUserInfoTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Foundation\Http\FormRequest;
use Smareco\Customers\Command\UseCases\SyncCustomers\SyncCustomersInputPort;
use Smareco\Customers\Command\UseCases\SyncProducts\SyncProductsInputPort;
use Smareco\Customers\Command\UseCases\SyncTransaction\SyncTransactionInputPort;
use Smareco\Shared\Models\ValueObjects\AccessToken;

class SyncCustomerRequest extends FormRequest implements SyncCustomersInputPort, SyncTransactionInputPort, SyncProductsInputPort
{
    use GetSmaregiUserInfoTrait, GetProviderTrait;

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

    public function providerId(): string
    {
        return $this->getProviderId();
    }

    public function from(): DateTimeInterface
    {
        return Carbon::now()->subMonth();
    }

    public function to(): DateTimeInterface
    {
        return Carbon::now();
    }
}
