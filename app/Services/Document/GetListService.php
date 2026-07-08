<?php

namespace App\Services\Document;

use App\Http\Resources\ListDocumentsResource;
use App\Repositories\Document\IDocumentRepo;

class GetListService
{
    public function __construct(
        protected readonly IDocumentRepo $documentRepo,
    ) {}

    public function execute(?array $attributes = null): ListDocumentsResource
    {
        $result = $this->documentRepo->getList($attributes);
        return ListDocumentsResource::make($result);
    }
}
