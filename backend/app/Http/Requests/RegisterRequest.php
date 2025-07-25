<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "firstName"=> "required|string|max:255",
            "lastName"=> "required|string|max:255",
            "middleName"=> "nullable|string|max:255",
            "email"=> "required|email|max:255|unique:users,email",
            "password"=> "required|string|min:8|confirmed",
            "role"=> "required|exists:roles,id",
        ];
    }
}
