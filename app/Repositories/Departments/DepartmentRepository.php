<?php

namespace App\Repositories\Departments;

use App\Interfaces\Department\RepositoryBaseInterface;
use App\Models\Departments\Department;
use App\ValueObjects\Departments\CreatableService;
use App\ValueObjects\Departments\EditableService;
use App\ValueObjects\Generals\CreatableObject;
use App\ValueObjects\Generals\EditableObject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DepartmentRepository implements RepositoryBaseInterface
{

    /**
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): Model|null
    {
        return Department::query()
            ->withoutGlobalScopes()
            ->whereNull('deleted_at')
            ->find($id);
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return Department::query()
            ->selectRaw('departments.*')
            ->where('active', 1)
            ->get();
    }

    /**
     * @param CreatableObject $object
     * @return Model|null
     */
    public function create(CreatableObject $object): Model|null
    {
       return Department::createNew($object);
    }

    /**
     * @param Model $object,
     * @param EditableObject $newObject
     * @return bool
     */
    public function update(Model $object, EditableObject $newObject): bool
    {
        $object->name = $newObject->getName();

        return $object->save();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return Department::query()->withoutGlobalScopes()->find($id)->delete();
    }
}
