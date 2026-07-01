<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditDocumentRequest;
use App\Services\Document\SaveService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class DocumentController extends Controller
{
    public function __construct(
        protected readonly SaveService $saveService,
    ) {}

    public function new(): JsonResponse
    {
        try {
            $this->saveService->execute();

            return Response::success(message: 'Document created successfully.');
        } catch (Exception $e) {
            return Response::error(message: $e->getMessage());
        }
    }

    public function edit(EditDocumentRequest $request, string $documentId): JsonResponse
    {
        try {
            $this->saveService->execute(documentId: $documentId, params: $request->validated());

            return Response::success(message: 'Document updated successfully.');
        } catch (Exception $e) {
            return Response::error(message: $e->getMessage());
        }
    }
}
