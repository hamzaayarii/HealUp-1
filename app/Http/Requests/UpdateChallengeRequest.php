<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChallengeRequest extends FormRequest
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
        $challengeId = $this->route('id'); // Récupère l'ID du défi depuis la route
        
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'objectif' => 'required|integer|min:1',
            'duration' => 'required|integer|min:1|max:365',
            'reward' => 'required|string|max:255',
            'start_date' => [
            'required',
            'date',
            function ($attribute, $value, $fail) use ($challengeId) {
                $challenge = \App\Models\Challenge::find($challengeId);
                // Si la date change et que c'est dans le passé, refuser
                if ($challenge && $value != $challenge->start_date->format('Y-m-d') && strtotime($value) < strtotime('today')) {
                    $fail("La date de début ne peut pas être dans le passé.");
                }
            }
        ],
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:pending,approved,rejected',
        ];
    }
}
