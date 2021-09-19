<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidateUser extends FormRequest
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
            
            'full_name'=>['required','max:255'],
            'first_name'=>['string','max:255'],
            'role'=>['required', 'string','max:255'],
            'img' => 'image|max:2048|mimes:jpg,bmp,png',
            'middle_name'=>['string','max:255'],
            'last_name'=>['string','max:255'],
            'user_name'=>['string', 'max:255',  Rule::unique('users')->ignore($this->user) ],
            'email'=>['required', 'string','max:255','email',  Rule::unique('users')->ignore($this->user)],
            'phone'=>['required', 'string',  Rule::unique('users')->ignore($this->user)],
            'address'=>['string','max:255'],
            'biography'=>['string', 'max:255'],
            'password' => ['required','min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/','max:255'],
            'password_again' => ['same:password'],            
            'id_number'=> [ 'integer',  Rule::unique('users')->ignore($this->user)],
            'passport_no'=> [ 'string', 'max:255',  Rule::unique('users')->ignore($this->user)],
            'dob'=> ['date'],
            'city'=> ['string', 'max:255'],
            'postal_code'=> ['string', 'max:255'],
            'physical_address'=> ['string', 'max:255'],
            'suspended_at'=> ['date'],
            'email_verified_at'=> ['date'],
            'id_verified_at'=> ['date'],
            'gender'=> ['integer'],
            'nationality'=> ['string', 'max:255'],
            'approved_by'=> ['integer'],
            'registered_by'=> ['integer'],
            'suspended_by'=> ['integer'],
            'avatar'=> ['string', 'max:255'],
            'remember_token' => ['string']
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'password.regex' => 'Password must contain at least one uppercase and one lowercase letters, one number and one special character',
            'full_name.required' => 'Please provide your full name',
            'role.required' => 'Please specify a role',
            'email.required' => 'Please provide a valid email address',
            'phone.required' => 'Please provide your phone number',
            'password.required' => 'Please  enter your password',
            'password_again.required' => 'Please  enter your password again'
        ];
    }

}
