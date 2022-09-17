<?php

namespace App\Http\Requests\Admin\Chapters;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'id_chapter' => '',
            'id_manga'=> '',
            'tom'=>'',
            'number'=>'',
            'title'=>'',
            'premium'=>'',
            'hide_18'=>'',
            'hide'=>'',
            'date_of_free'=>''
            ];
    }
}
