<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            "page" => ["required", "string"],
            "limit" => ["required", "string"],
            "sort_column" => ["string"],
            "sort_direction" => ["string"]
        ];
    }
}
