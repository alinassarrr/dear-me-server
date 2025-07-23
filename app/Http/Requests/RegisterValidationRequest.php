<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterValidationRequest extends FormRequest
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
            'email'=>['required','string','email','unique:users'],
            'password'=>['required','string','min:5'],
            "username"=> ["required","string"]        
        ];
    }
     public function messages(): array{
        return [
            "email.required" => "Email is required",
            "username.required"=> "Username is required",
            "email.email"=> "Enter Valid Email",
            "password.min"=>"Password must be at least 5 characters",
            'email.unique' => 'This email is already registered. Try logging in instead.',
        ];
    }
}
