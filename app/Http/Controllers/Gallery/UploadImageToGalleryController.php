<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Galleries\Gallery;
use App\Repositories\Gallery\GalleryRepository;
use App\Resources\Gallery\GalleryResource;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UploadImageToGalleryController extends Controller
{
    public function __construct(
        private GalleryRepository $repository
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {

            $file = $request->file;

            if (is_null($file)) {
                throw new Exception("No se ha encontrado la imagen");
            }

            $url = $this->generalMethods()->saveFile("gallery", $file);

            $image = Gallery::query()->create([
                'url' => $url,
                'date' => Carbon::now()->format('d/m/Y h:i:s'),
                'active' => true,
            ]);

            return $this->generalMethods()->responseToApp(1, new GalleryResource($image));

        } catch (Exception $e) {
            return $this->generalMethods()->responseToApp(0, [], $e->getMessage());
        }
    }
}
