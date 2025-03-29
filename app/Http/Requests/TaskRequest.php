<?php

namespace App\Http\Requests;

use App\Enums\Statuses;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
            'status' => ['required', 'string', Rule::in(Statuses::taskStatuses())],
            'start_date' => ['required', 'date', Rule::when($this->isMethod('POST'), 'after_or_equal:today')],
            'end_date' => ['nullable', 'date', 'after:start_date'],
        ];
    }
}
