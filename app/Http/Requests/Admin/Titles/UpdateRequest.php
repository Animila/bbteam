<?php

namespace App\Http\Requests\Admin\Titles;

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
            'title_ru'=>'required',
            'title_eng'=>'required',
            'title_korean'=>'',
            'description'=>'required',
            'id_type'=>'',
            'id_status'=>'',
            'id_tags[]'=>'array',
            'id_tags'=>'required',
            'id_genres[]'=>'array',
            'id_genres'=>'required',
            'hide'=>'',
            'hide_18'=>'',
            'image'=>'image',
            'id_manga'=>''
        ];
    }
    public function messages()
    {
        return [
            'title_ru.required'=>'Заполните поля',
            'title_eng.required'=>'Заполните поля',
            'description.required'=>'Заполните поля',
            'id_tags.required'=>'Заполните поля',
            'id_genres.required'=>'Заполните поля',
            'image.image'=>'Загрузить файлы изображений'
        ];
    }
}
