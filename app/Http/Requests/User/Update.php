<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class Update extends FormRequest
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
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->route('user'))],
            'phone' => ['required', 'numeric', 'digits_between:11,15', Rule::unique('users', 'phone')->ignore($this->route('user'))],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'title' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:4096',
        ];
    }
}
