<?php

namespace App\Http\Requests\RefundRequest;

use Illuminate\Foundation\Http\FormRequest;

class ValidateRefundRequest extends FormRequest
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
            'order_id'=>['required', 'integer'],
            'status'=>['nullable', 'string'],
            'reason'=>['required', 'string'],
            'more_explanation'=>['required', 'string'],
            'deleted_at'=>['nullable','date'],
            'supended_at'=>['nullable','date']
        ];
    }
}
