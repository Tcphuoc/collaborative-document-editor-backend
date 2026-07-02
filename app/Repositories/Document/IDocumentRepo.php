<?php

namespace App\Repositories\Document;

use App\Repositories\IBaseRepo;

interface IDocumentRepo extends IBaseRepo {
    public function getList(?array $attributes = null);
}
