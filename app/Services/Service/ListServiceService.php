<?php

namespace App\Services\Service;

use App\Repositories\Service\ServiceRepository;
use App\Resources\Service\ServiceResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ListServiceService
{
    protected ServiceRepository $repository;

    public function __construct(ServiceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function list(): AnonymousResourceCollection
    {
        $services = $this->repository->list();

        return ServiceResource::collection($services);
    }
}
