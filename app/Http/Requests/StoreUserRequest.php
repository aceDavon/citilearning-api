<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'type' => ['required', Rule::in(['staff', 'student', 'developer'])],
            'phone' => ['required', 'unique:users,phone'],
            'username' => ['required', 'unique:users,username'],
            'address' => ['required'],
        ];
    }
}
