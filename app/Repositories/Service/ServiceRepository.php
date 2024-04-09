<?php

namespace App\Repositories\Service;

use App\Interfaces\Department\RepositoryBaseInterface;
use App\Models\Services\Services;
use App\ValueObjects\Generals\CreatableObject;
use App\ValueObjects\Generals\EditableObject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ServiceRepository implements RepositoryBaseInterface
{


    /**
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): Model|null
    {
        return Services::query()->withoutGlobalScopes()->find($id);
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return Services::query()
            ->where('active', 1)
            ->get();
    }

    /**
     * @param CreatableObject $object
     * @return Model|null
     */
    public function create(CreatableObject $object): Model|null
    {
        return Services::createNew($object);
    }

    /**
     * @param Model $object
     * @param EditableObject $newObject
     * @return bool
     */
    public function update(Model $object, EditableObject $newObject): bool
    {
        // TODO: Implement update() method.
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return Services::query()->withoutGlobalScopes()->find($id)->delete();
    }
}
