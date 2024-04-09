<?php

namespace App\Services\Service;

use App\Repositories\Service\ServiceRepository;
use App\Resources\Service\ServiceResource;
use Exception;

class GetServiceService
{
    protected ServiceRepository $repository;

    public function __construct(ServiceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws Exception
     */
    public function find(int $id): ServiceResource
    {
        $service = $this->repository->find($id);

        if (is_null($service)) {
            throw new Exception("No se ha encontrado el servicio");
        }

        return new ServiceResource($service);
    }
}
