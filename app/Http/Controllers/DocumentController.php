<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetListDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Services\Document\CreateService;
use App\Services\Document\GetListService;
use App\Services\Document\UpdateService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class DocumentController extends Controller
{
    public function __construct(
        protected readonly GetListService $getListService,
        protected readonly CreateService $createService,
        protected readonly UpdateService $updateService,
    ) {}

    public function index(GetListDocumentRequest $request): JsonResponse
    {
        try {
            $data = $this->getListService->execute($request->validated());

            return Response::success(data: $data, message: "Get list documents successfully");
        } catch (Exception $e) {
            return Response::error(message: $e->getMessage());
        }
    }

    public function create(): JsonResponse
    {
        try {
            $this->createService->execute();

            return Response::success(message: 'Document created successfully.');
        } catch (Exception $e) {
            return Response::error(message: $e->getMessage());
        }
    }

    public function update(UpdateDocumentRequest $request, string $documentId): JsonResponse
    {
        try {
            $this->updateService->execute(documentId: $documentId, params: $request->validated());

            return Response::success(message: 'Document updated successfully.');
        } catch (Exception $e) {
            return Response::error(message: $e->getMessage());
        }
    }
}
