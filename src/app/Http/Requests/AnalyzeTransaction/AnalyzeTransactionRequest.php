<?php
declare(strict_types=1);

namespace App\Http\Requests\AnalyzeTransaction;

use App\Traits\GetSmaregiUserInfoTrait;
use Carbon\Carbon;
use DateTimeInterface;
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
            $query = http_build_query([
                'contract_id' => 'sb_skc216v8',
                config('smareco.webhook_header.key') => config('smareco.webhook_header.value'),
            ]);
            return 'https://smareco.nozomi.bike/webhook/ai/notification?' . $query;
        }
        $query = http_build_query([
            'contract_id' => $this->contractId(),
            config('smareco.webhook_header.key') => config('smareco.webhook_header.value'),
        ]);
        return (string) config('smareco.ai.notification_url') . '?' . $query;
    }

    public function providerId(): string
    {
        return config('smareco.providers.smaregi');
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
