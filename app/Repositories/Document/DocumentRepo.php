<?php

namespace App\Repositories\Document;

use App\Models\Document;
use App\Repositories\BaseRepo;
use Illuminate\Database\Eloquent\Collection;

class DocumentRepo extends BaseRepo implements IDocumentRepo
{
    protected function model(): string
    {
        return Document::class;
    }

    public function getList(?array $attributes = null): array
    {
        $query = $this->model->newModelQuery()->with('createdUser');
        
        if (isset($attributes["search"])) {
            $query = $query->where("title", "like", "%{$attributes['search']}%");
        }

        $limit = $attributes["limit"] ?? 10;
        $currentPage = $attributes["page"] ?? 1;
        $offset = ($currentPage - 1) * $limit;
        $orderColumn = $attributes["sort_column"] ?? "id";
        $orderDirection = $attributes["sort_direction"] ?? "asc";
        $totalRecords = $query->count();

        $query = $query->offset($offset)
            ->limit($limit)
            ->orderBy($orderColumn, $orderDirection);

        return [
            "documents" => $query->get(),
            "pagination_data" => [
                "page" => $currentPage,
                "limit" => $limit,
                "total" => $totalRecords,
            ],
        ];
    }
}
