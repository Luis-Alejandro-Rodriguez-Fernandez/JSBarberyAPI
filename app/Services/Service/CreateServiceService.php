<?php

namespace App\Services\Service;

use App\Models\Services\Services;
use App\Repositories\Service\ServiceRepository;
use App\Resources\Service\ServiceResource;
use App\ValueObjects\Services\CreatableService;
use Illuminate\Database\Eloquent\Model;

class CreateServiceService
{
    protected ServiceRepository $repository;

    public function __construct(ServiceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(CreatableService $creatableService): ServiceResource
    {
        $service = $this->repository->create($creatableService);

        return new ServiceResource($service);
    }
}
