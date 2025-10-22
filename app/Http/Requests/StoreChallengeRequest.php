<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChallengeRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'objectif' => 'required|integer|min:1',
            'duration' => 'required|integer|min:1|max:365',
            'reward' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ];
    }

    public function messages(): array
{
    return [
        // Title field messages
        'title.required' => 'The challenge title is required.',
        'title.string' => 'The challenge title must be a valid text.',
        'title.max' => 'The challenge title must not exceed 255 characters.',

        // Objectif field messages
        'objectif.required' => 'The daily goal is required.',
        'objectif.integer' => 'The daily goal must be a whole number.',
        'objectif.min' => 'The daily goal must be at least 1.',

        // Duration field messages
        'duration.required' => 'The challenge duration is required.',
        'duration.integer' => 'The duration must be a whole number of days.',
        'duration.min' => 'The duration must be at least 1 day.',
        'duration.max' => 'The duration must not exceed 365 days.',

        // Reward field messages
        'reward.required' => 'The reward description is required.',
        'reward.string' => 'The reward must be a valid text.',
        'reward.max' => 'The reward must not exceed 255 characters.',

        // Start_date field messages
        'start_date.required' => 'The start date is required.',
        'start_date.date' => 'The start date must be a valid date.',
        'start_date.after_or_equal' => 'The start date must be today or in the future.',

        // End_date field messages (optional field)
        'end_date.date' => 'The end date must be a valid date.',
        'end_date.after_or_equal' => 'The end date must be the same as or after the start date.',

];
}
}
