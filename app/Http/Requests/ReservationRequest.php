<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class ReservationRequest extends FormRequest
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
        $validateFunc = function($attribute, $value, $fail) {
            $inputData = $this->all();
            $resDateTime = Carbon::parse($inputData['resDate'] . ' ' . $inputData['resTime'] . ':00');
            if ($resDateTime->isToday() && $resDateTime->isPast()) {
                $fail('過去の時間指定です。'); 
            }
        };

        return [
            'resDate' => ['required', 'date_format:Y-m-d', 'after_or_equal:today'],
            'resTime' => ['required', 'date_format:H:i', $validateFunc],
            'num_of_seats' => ['required', 'max:255', 'integer'],
        ];
    }

    public function messages()
    {
        return[
            'required' => config('const.REQUIRED'),
            'after_or_equal' => config('const.PAST_DAY'),
            'date_format' => config('const.NOT_DATETIME'),
            'max' => config('const.OVER_MAX_NUM'),
            'integer' => config('const.NOT_INT'),
        ];
    }
}
