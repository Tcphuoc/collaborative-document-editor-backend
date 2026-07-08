<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $total = (int) $this['total'];
        $page = (int) $this["page"];
        $limit = (int) $this["limit"];

        $remainingRecords = $total - ($page * $limit);

        return [
            "current_page" => $page,
            "previous_page" => $page > 1 ? $page - 1 : null,
            "next_page" => $remainingRecords > 0 ? $page + 1 : null,
            "limit" => $limit,
            "total" => $total,
        ];
    }
}
