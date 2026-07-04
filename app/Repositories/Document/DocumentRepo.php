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

    public function getList(?array $attributes = null): Collection
    {
        $query = $this->model->newModelQuery()->with('createdUser');
        
        if (isset($attributes["search"])) {
            $query = $query->where("title", "like", "%{$attributes['search']}%");
        }

        $limit = $attributes["limit"] ?? 10;
        $offset = (($attributes["page"] ?? 1) - 1) * $limit;
        $orderColumn = $attributes["order_column"] ?? "id";
        $orderDirection = $attributes["order_direction"] ?? "asc";

        $query = $query->offset($offset)
            ->limit($limit)
            ->orderBy($orderColumn, $orderDirection);

        return $query->get();
    }
}
