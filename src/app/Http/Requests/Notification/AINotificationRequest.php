<?php
declare(strict_types=1);

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;
use Smareco\AIProcessHistory\Command\UseCases\SaveAIProcessHistory\SaveAIProcessHistoryInputPort;

class AINotificationRequest extends FormRequest implements SaveAIProcessHistoryInputPort
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
            'contract_id' => ['required', 'string'],
            'username' => ['required', 'string'],
            'text' => ['required', 'string'],
        ];
    }

    public function contractId(): string
    {
        return $this->get('contract_id', '') ?? '';
    }

    public function processName(): string
    {
        return $this->get('username', '') ?? '';
    }

    public function processText(): string
    {
        return $this->get('text', '') ?? '';
    }
}
