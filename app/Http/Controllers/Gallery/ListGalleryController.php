<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Repositories\Gallery\GalleryRepository;
use App\Resources\Gallery\GalleryResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ListGalleryController extends Controller
{
    public function __construct(
        private GalleryRepository $repository
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $departmentId = $request->get('department_id');

            $filters = [
                'department_id' => $departmentId,
            ];

            $images = $this->repository->list($filters);

            return $this->generalMethods()->responseToApp(1, GalleryResource::collection($images));

        } catch (Exception $e) {
            return $this->generalMethods()->responseToApp(0, [], $e->getMessage());
        }
    }
}
