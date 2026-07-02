<?php

namespace App\Services\Document;

use App\Models\Document;
use App\Repositories\Document\IDocumentRepo;

class UpdateService
{
    public function __construct(
        protected readonly IDocumentRepo $documentRepo,
    ){}

    public function execute(string $documentId, array $params): Document
    {
        return $this->documentRepo->update($documentId, $params);
    }
}
