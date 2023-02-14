<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $method = $this->method();
        if($method == 'PUT') {
            return [
                'name' => ['required'],
                'email' => ['required', 'email'],
                'type' => ['required', Rule::in(['staff', 'student', 'developer'])],
                'phone' => ['required', 'unique:users,phone'],
                'username' => ['required', 'unique:users,username'],
                'address' => ['required'],
            ];
        }else {
            return [
                'name' => ['sometimes', 'required'],
                'email' => ['sometimes', 'required', 'email'],
                'type' => ['sometimes', 'required', Rule::in(['staff', 'student', 'developer'])],
                'phone' => ['sometimes', 'required', 'unique:users,phone'],
                'username' => ['sometimes', 'required'],
                'address' => ['sometimes', 'required'],
            ];
        }
    }
}
