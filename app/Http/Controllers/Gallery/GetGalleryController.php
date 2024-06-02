<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Repositories\Gallery\GalleryRepository;
use App\Resources\Gallery\GalleryResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetGalleryController extends Controller
{
    public function __construct(
        private GalleryRepository $repository
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $id = $request->get('id');

            $image = $this->repository->find($id);

            if (is_null($image)) {
                throw new Exception("No se ha encontrado la imagen");
            }

            return $this->generalMethods()->responseToApp(1, new GalleryResource($image));

        } catch (Exception $e) {
            return $this->generalMethods()->responseToApp(0, [], $e->getMessage());
        }
    }
}
