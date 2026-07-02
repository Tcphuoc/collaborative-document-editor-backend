<?php

namespace App\Services\Document;

use App\Models\Document;
use App\Repositories\Document\IDocumentRepo;

class CreateService
{
    public function __construct(
        protected readonly IDocumentRepo $documentRepo,
    ){}

    public function execute(
        array $params = [
            "title" => "New document",
            "content" => "",
        ],
    ): Document
    {
        return $this->documentRepo->create($params);
    }
}
