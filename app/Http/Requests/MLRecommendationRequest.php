<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MLRecommendationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'city' => 'required|in:turku,Turku,TURKU',
            'budget' => 'required|numeric|min:50|max:5000',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'food' => 'required|array|min:3',
            'interest' => 'required|array|min:3',
        ];
    }
}
