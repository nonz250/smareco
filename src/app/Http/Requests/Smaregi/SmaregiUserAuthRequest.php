<?php
declare(strict_types=1);

namespace App\Http\Requests\Smaregi;

use Illuminate\Foundation\Http\FormRequest;
use Smareco\SmaregiUserInfo\Command\UseCases\SaveSmaregiUserInfo\SaveSmaregiUserInfoInputPort;

class SmaregiUserAuthRequest extends FormRequest implements SaveSmaregiUserInfoInputPort
{
    /**
     * バリデーションに失敗したときはログイン画面へ戻す。
     *
     * @var string
     */
    protected $redirect = '/login';

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
            'code' => ['required', 'string'],
            'state' => ['required', 'string'],
        ];
    }

    /**
     * @return string
     */
    public function grantType(): string
    {
        return (string) 'authorization_code';
    }

    /**
     * @return string
     */
    public function code(): string
    {
        return $this->get('code', '') ?? '';
    }

    /**
     * @return string
     */
    public function redirectUri(): string
    {
        return (string) route('openid');
    }
}
