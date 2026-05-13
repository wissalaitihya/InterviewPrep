<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreConceptRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'domain_id' => [
                'required',
                'integer',
                Rule::exists('domains', 'id')->where('user_id', auth()->id()),
            ],
            'title' => 'required|string|max:255',
            'explanation' => 'required|string',
            'difficulty' => 'required|in:junior,mid,senior',
            'status' => 'sometimes|in:to_review,in_progress,mastered',
        ];
    }
}
