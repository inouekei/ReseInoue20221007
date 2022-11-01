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
            'name' => ['required', 'max:191', 'string'],
            'email' => ['required', 'max:191', 'string', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'max:191', 'string'],
        ];
    }

    public function messages()
    {
        return[
            'required' => config('const.REQUIRED'),
            'max' => config('const.OVER_MAX'),
            'string' => config('const.NOT_STRING'),
            'email' => config('const.NOT_EMAIL'),
            'unique' => config('const.NOT_UNIQUE'),
            'min' => config('const.UNDER_MIN'),
        ];
    }
}
