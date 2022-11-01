<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailVerificationRequest extends FormRequest
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
            'email' => ['required', 'max:191', 'string', 'email', 'exists:users'],
        ];
    }

    public function messages()
    {
        return[
            'required' => config('const.REQUIRED'),
            'max' => config('const.OVER_MAX'),
            'string' => config('const.NOT_STRING'),
            'exists' => config('const.NOT_EXISTS'),
        ];
    }
}
