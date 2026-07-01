<?php

namespace App\Services\Document;

use App\Models\Document;
use App\Repositories\Document\IDocumentRepo;

class SaveService
{
    public function __construct(
        protected readonly IDocumentRepo $documentRepo,
    ){}

    public function execute(
        array $params = [
            "title" => "New document",
            "content" => "",
        ],
        ?string $documentId = null
    ): Document
    {
        return $documentId === null
            ? $this->documentRepo->create($params)
            : $this->documentRepo->update($documentId, $params);
    }
}
