<?php
declare(strict_types=1);

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetCustomersRequest extends FormRequest
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
            'page' => ['nullable', 'integer'],
            'length' => ['nullable', 'integer'],
            'order' => ['nullable', 'string', Rule::in(['asc', 'desc'])],
            'order_key' => ['nullable', 'string'],
            'name' => ['nullable', 'string'],
            'store_id' => ['nullable', 'integer'],
        ];
    }
}
