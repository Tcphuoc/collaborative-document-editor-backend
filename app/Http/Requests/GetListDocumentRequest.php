<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetListDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "search" => ["string"],
            "page" => ["required", "integer"],
            "limit" => ["required", "integer"],
            "sort_column" => ["string"],
            "sort_direction" => Rule::in(['asc', 'desc'])
        ];
    }
}
