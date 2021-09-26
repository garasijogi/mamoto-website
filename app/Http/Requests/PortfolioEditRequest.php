<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioEditRequest extends FormRequest
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
            'fileList.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10024',
            'name' => 'required',
            'pfType_id' => 'required',
            'videoList' => 'video|mimes:3gp,mp4,mkv,avi,wmv|max:100024',
            'venue' => '',
            'pv' => '',
            'makeup' => '',
            'decoration' => '',
            'attire' => '',
            'henna' => '',
            'wo' => '',
            'lighting' => '',
            'date' => 'required',
        ];
    }
}
