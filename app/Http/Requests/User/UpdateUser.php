<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUser extends FormRequest
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
            'first_name'=>['required', 'string','max:255'],
            'middle_name'=>['string','max:255'],
            'last_name'=>['required', 'string','max:255'],
            'img' => 'image|max:2048',
            'user_name'=>['string','max:255',  Rule::unique('users')->ignore($this->user) ],
            'email'=>['required', 'string','max:255', 'email', Rule::unique('users')->ignore($this->user)],
            'phone'=>['required', 'string', Rule::unique('users')->ignore($this->user)],
            'address'=>['string','max:255'],
            'biography'=>['string', 'max:255'],
            'id_number'=> [ 'integer', Rule::unique('users')->ignore($this->user)],
            'passport_no'=> [ 'string', 'max:255', Rule::unique('users')->ignore($this->user)],
            'dob'=> ['date'],
            'city'=> ['string', 'max:255'],
            'postal_code'=> ['string', 'max:255'],
            'physical_address'=> ['string', 'max:255'],
            'email_verified_at'=> ['date'],
            'id_verified_at'=> ['date'],
            'gender'=> ['integer'],
            'nationality'=> ['string', 'max:255'],            
            'avatar'=> ['string', 'max:255'],
            'remember_token' => ['string']
        ];
    }
}
