<?php


namespace App\Models\Departments;


use App\ValueObjects\Departments\CreatableDepartment;
use App\ValueObjects\Departments\EditableDepartment;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $table = "departments";

    protected $fillable = [
        'name',
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function createNew(CreatableDepartment $creatableDepartment): Model
    {
        return self::query()->create([
            'name' => $creatableDepartment->getName(),
        ]);
    }

    /**
     * @throws Exception
     */
    public function updateModel(EditableDepartment $newDepartementData): void
    {
        $this->setName($newDepartementData->getName());

        if (!$this->save()) {
            throw new Exception("Hubo un error al actualizar el departamento");
        }
    }

    private function setName(string $name): void
    {
        $this->name = $name;
    }
}
