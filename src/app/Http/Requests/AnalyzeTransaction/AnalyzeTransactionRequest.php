<?php
declare(strict_types=1);

namespace App\Http\Requests\AnalyzeTransaction;

use App\Traits\GetSmaregiUserInfoTrait;
use Illuminate\Foundation\Http\FormRequest;
use Smareco\Customers\Command\UseCases\AnalyzeTransaction\AnalyzeTransactionInputPort;
use Smareco\Customers\Command\UseCases\CreateProductPurchaseCsv\CreateProductPurchaseCsvInputPort;

class AnalyzeTransactionRequest extends FormRequest implements CreateProductPurchaseCsvInputPort, AnalyzeTransactionInputPort
{
    use GetSmaregiUserInfoTrait;

    private string $csvPath;

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

    public function apiKey(): string
    {
        return config('smareco.ai.api_key', '') ?? '';
    }

    public function contractId(): string
    {
        return $this->getSmaregiUserInfoSession()->getSmaregiUserInfo()->contractId();
    }

    public function csvPath(): string
    {
        return $this->csvPath;
    }

    public function setCsvPath(string $csvPath): void
    {
        $this->csvPath = $csvPath;
    }

    public function notificationUrl(): string
    {
        if (config('app.env') === 'local') {
            return 'https://labo.nozomi.bike/api/webhook';
//            return 'https://smaregi.nozomi.bike/api/smaregi/webhook';
        }
        return (string) config('smareco.ai.notification_url');
    }
}
