<?php
declare(strict_types=1);

namespace App\Http\Requests\SmaregiUserInfo;

use Illuminate\Foundation\Http\FormRequest;
use Smareco\SmaregiUserInfo\Command\UseCases\GetSmaregiUserInfo\GetSmaregiUserInfoInputPort;

class GetSmaregiUserInfoRequest extends FormRequest implements GetSmaregiUserInfoInputPort
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
}
