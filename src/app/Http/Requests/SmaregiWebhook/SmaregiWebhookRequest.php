<?php
declare(strict_types=1);

namespace App\Http\Requests\SmaregiWebhook;

use Illuminate\Foundation\Http\FormRequest;
use Smareco\SmaregiWebhook\SmaregiWebhookInputPort;

class SmaregiWebhookRequest extends FormRequest implements SmaregiWebhookInputPort
{
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

    public function event(): string
    {
        return $this->header('smaregi-event', '') ?? '';
    }

    public function isCustomer(): bool
    {
        return $this->event() === (string) config('smareco.webhooks.customer');
    }

    public function providerId(): string
    {
        return config('smareco.providers.smaregi');
    }

    public function contractId(): string
    {
        return $this->header('smaregi-contract-id', '') ?? '';
    }

    public function body(): array
    {
        return $this->toArray();
    }
}
