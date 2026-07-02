<?php

namespace App\Services\Document;

use App\Http\Resources\ListDocumentsResource;
use App\Repositories\Document\IDocumentRepo;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetListService
{
    public function __construct(
        protected readonly IDocumentRepo $documentRepo,
    ) {}

    public function execute(?array $attributes = null): AnonymousResourceCollection
    {
        $result = $this->documentRepo->getList($attributes);
        return ListDocumentsResource::collection($result);
    }
}
