<?php

namespace App\Http\Requests;

use App\Enums\Statuses;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchTaskRequest extends FormRequest
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
            'text' => 'nullable|string',
            'status' => ['nullable', 'string', Rule::in(Statuses::taskStatuses())],
            'order' => ['nullable', 'string', Rule::in(['asc', 'desc'])],
        ];
    }
}
