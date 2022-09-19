<?php

namespace App\Http\Requests\Admin\Users;

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
            'nickname'=>'string|filled|required|unique:users,nickname,'.$this->id,
            'email'=>'string|filled|required|email|unique:users,email,'.$this->id,
            'name'=>'required',
            'gender'=>'required',
            'about'=>'',
            'id'=>'',
            'hide_18'=>'',
            'premium'=>'',
            'role'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'email.unique'=>'Такая почта уже привязана к другому аккаунту',
            'nickname.unique'=>'Данный никнейм уже занят'
        ];
    }
}
