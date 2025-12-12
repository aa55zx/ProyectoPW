<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventoRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'event_start_date' => 'required|date',
            'event_end_date' => 'required|date|after_or_equal:event_start_date',
            'registration_start_date' => 'required|date',
            'registration_end_date' => 'required|date|after_or_equal:registration_start_date',
            'min_team_size' => 'required|integer|min:1',
            'max_team_size' => 'required|integer|min:1',
            'max_teams' => 'nullable|integer|min:1',
            'location' => 'nullable|string',
            'is_online' => 'boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'El título del evento es obligatorio.',
            'title.max' => 'El título no puede superar los 255 caracteres.',
            'description.required' => 'La descripción del evento es obligatoria.',
            'category.required' => 'La categoría del evento es obligatoria.',
            'event_start_date.required' => 'La fecha de inicio del evento es obligatoria.',
            'event_start_date.date' => 'La fecha de inicio debe ser una fecha válida.',
            'event_end_date.required' => 'La fecha de finalización del evento es obligatoria.',
            'event_end_date.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio.',
            'registration_start_date.required' => 'La fecha de inicio de registro es obligatoria.',
            'registration_end_date.required' => 'La fecha de finalización de registro es obligatoria.',
            'registration_end_date.after_or_equal' => 'La fecha de finalización de registro debe ser igual o posterior a la fecha de inicio de registro.',
            'min_team_size.required' => 'El tamaño mínimo del equipo es obligatorio.',
            'min_team_size.min' => 'El tamaño mínimo del equipo debe ser al menos 1.',
            'max_team_size.required' => 'El tamaño máximo del equipo es obligatorio.',
            'max_team_size.min' => 'El tamaño máximo del equipo debe ser al menos 1.',
            'max_teams.min' => 'El número máximo de equipos debe ser al menos 1.',
        ];
    }
}
