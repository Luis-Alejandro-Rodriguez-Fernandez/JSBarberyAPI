<?php

namespace App\Services\Service;

use App\Models\Services\Services;
use App\Repositories\Service\ServiceRepository;
use App\Resources\Service\ServiceResource;
use App\ValueObjects\Services\EditableService;
use Exception;

class UpdateServiceService
{
    protected ServiceRepository $repository;

    public function __construct(ServiceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws Exception
     */
    public function update(int $id, EditableService $newServiceData): ServiceResource
    {
        $service = Services::query()->find($id);

        if (is_null($service)) {
            throw new Exception("No se ha encontrado el servicio");
        }

        $service->updateModel($newServiceData);

        return new ServiceResource($service);
    }
}
