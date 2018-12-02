<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
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
            'firstname'     =>  'required|min:2|max:50',
            'lastname'      =>  'required|min:2|max:50',
            'email'         =>  'required|email|unique:users',
            'phone_number'  =>  'required|numeric|phone',
            'password'  	=> 'required|max:15|min:6',
            'terms'         =>  'required',
            // 'g-recaptcha-response' => 'required|captcha'
        ];
    }
    public function messages()
    {
        return [
            'terms.required'                    => 'You have to agree with our Terms & Condition',
            'password.regex'  		            => 'password must contain atleast one number and one letter',
            'g-recaptcha-response.required'     => 'Prove that you are a human',
            'g-recaptcha-response.captcha'      => 'Invalid captcha response',
        ];
    }
}
