<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListDocumentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "documents" => DocumentResource::collection($this['documents']),
            "pagination_data" => PaginationResource::make($this['pagination_data'])
        ];
    }
}
