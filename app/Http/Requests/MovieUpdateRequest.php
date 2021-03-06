<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'=>'required',
            'slug'=>'required|unique:movies,slug,'.$this->movie,'user_id'=>'required|integer',
            'category_id'=>'required|integer',
            'sinopsis',

        ];
        if($this->get('file'))
        $rules = array_merge($rules,['file'=>'mimes:jpg,jpeg,png']);

        return $rules;
    }
}
