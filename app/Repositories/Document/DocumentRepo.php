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
        return $this->model->load('createdUser')->all();
    }
}
