<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetConfirmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|exists:users|email',
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6'
        ];
    }
}
