<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactsUpdateFilter extends FormRequest
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
            'name' => 'required|min:5|max:70|unique:contacts,name,'.request()->input('id').',id' ,
            'contact' => 'required|min:9|numeric|unique:contacts,contact,'.request()->input('id').',id' ,
            'email' => 'required|min:10|max:90|unique:contacts,email,'.request()->input('id').',id' ,
        ];
    }
}
