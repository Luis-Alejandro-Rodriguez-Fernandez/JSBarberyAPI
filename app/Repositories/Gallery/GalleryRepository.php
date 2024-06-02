<?php


namespace App\Repositories\Gallery;


use App\Models\Galleries\Gallery;
use Illuminate\Database\Eloquent\Collection;

class GalleryRepository
{

    public function find(int $id): ?Gallery
    {
        return Gallery::query()->find($id);
    }

    public function list(array $filters = []): Collection
    {
        return Gallery::query()
            ->when(!empty($filters['department_id']), function ($q) use ($filters) {
                $q->where('id_department', $filters['department_id']);
            })
            ->get();
    }

}
