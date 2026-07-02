<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditDocumentRequest;
use App\Services\Document\CreateService;
use App\Services\Document\UpdateService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class DocumentController extends Controller
{
    public function __construct(
        protected readonly CreateService $createService,
        protected readonly UpdateService $updateService,
    ) {}

    public function create(): JsonResponse
    {
        try {
            $this->createService->execute();

            return Response::success(message: 'Document created successfully.');
        } catch (Exception $e) {
            return Response::error(message: $e->getMessage());
        }
    }

    public function update(EditDocumentRequest $request, string $documentId): JsonResponse
    {
        try {
            $this->updateService->execute(documentId: $documentId, params: $request->validated());

            return Response::success(message: 'Document updated successfully.');
        } catch (Exception $e) {
            return Response::error(message: $e->getMessage());
        }
    }
}
