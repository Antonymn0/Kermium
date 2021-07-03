<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ValidateOrder extends FormRequest
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
            'user_id'=>['required', 'integer'],
            'topic'=>['required', 'string'],
            //'sample_file' => [ 'file|mimes:doc,docx,pdf,xls,xlsx|max:2048'],
            'status'=>['string'],
            'type'=>['required', 'string'],
            'deadline'=>['required', 'date'],
            'paper_type'=>['required', 'string'],
            'quantity'=>['required', 'integer'],
            'spacing'=>['required', 'string'],
            'pages'=>['nullable', 'integer'],
            'words'=>[ 'nullable','integer'],
            'academic_level'=>['nullable','string'],
            'instructions'=>['nullable', 'string'],
            'formating_style'=>[ 'nullable','string'],
            'number_of_sources'=>['nullable', 'integer'],
            'deleted_at'=>['nullable','date'],
            'supended_at'=>['nullable','date']
        ];
    }
}
