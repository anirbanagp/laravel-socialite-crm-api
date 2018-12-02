<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditProfile extends FormRequest
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
            'firstname'                 =>  'required|min:3|max:50',
            'lastname'                  =>  'required|min:2|max:50',
            'phone_number'              =>  'required|numeric|phone',
            'address'                   =>  'required|min:5',
            'gender'                    =>  'required',
            'image'                     =>  'mimes:jpeg,bmp,png,jpg',
            'password'  				=>  'nullable|max:15|min:6',
            'confirm_password'  		=>  'same:password',
        ];
    }
}
