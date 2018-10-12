<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email' => 'required|email',
            'register_date' => 'date:d.m.Y',
            'firstname' => 'max:64',
            'lastname' => 'max:64',
            'contact_phone' => 'max:64',
            'contact_vk' => 'max:64',
            'contact_fb' => 'max:64',
            'age' => 'max:2',
        ];
    }
}
