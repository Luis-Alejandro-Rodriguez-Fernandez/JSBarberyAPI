<?php

namespace App\Interfaces\Department;

use App\ValueObjects\Generals\CreatableObject;
use App\ValueObjects\Generals\EditableObject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryBaseInterface
{
    public function find(int $id): Model|null;
    public function list(): Collection;
    public function create(CreatableObject $object): Model|null;
    public function update(Model $object, EditableObject $newObject): bool;
    public function delete(int $id): bool;
}
