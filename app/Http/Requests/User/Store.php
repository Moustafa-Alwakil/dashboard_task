<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class Store extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|unique:users',
            'phone' => 'required|numeric|digits_between:11,15,unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'title' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:4096',
        ];
    }
}
