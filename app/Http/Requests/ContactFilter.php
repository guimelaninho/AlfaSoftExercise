<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFilter extends FormRequest
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
            'name' => 'required|min:5|max:70|unique:contacts,name',
            'contact' => 'required|min:9|max:9|unique:contacts,contact',
            'email' => 'required|min:10|max:90|unique:contacts,email|email',
        ];
    }
}
