<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Displayed_feedbackRequest extends FormRequest
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
            'dp_id' => 'required',
            'feedback_id' => 'required',
            'inputCustomerFile' => 'required'
        ];
    }
}
