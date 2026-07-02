<?php

namespace App\Repositories\Document;

use App\Models\Document;
use App\Repositories\BaseRepo;

class DocumentRepo extends BaseRepo implements IDocumentRepo
{
    protected function model(): string
    {
        return Document::class;
    }
}
