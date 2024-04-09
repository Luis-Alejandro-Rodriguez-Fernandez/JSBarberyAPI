<?php


namespace App\Models\Services;


use App\Models\Departments\Department;
use App\Traits\AllHelpersClass;
use App\ValueObjects\Generals\CreatableObject;
use App\ValueObjects\Services\CreatableService;
use App\ValueObjects\Services\EditableService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{
    use AllHelpersClass;
    use SoftDeletes;

    protected $table = "services";

    protected $fillable = [
        'id_department',
        'name',
        'description',
        'duration',
        'price',
        'active',
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getIdDepartment(): int
    {
        return $this->id_department;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getDurationString(): string
    {
        return $this->generalMethods()->parseMinutosToStringTime($this->duration);
    }

    public function getPrice(): array
    {
        return $this->generalMethods()->parseDatoNumerico($this->price, '€');
    }

    public function isActive(): bool
    {
        return (bool)$this->active;
    }

    //RELATIONS

    public function department()
    {
        return $this->belongsTo(Department::class, 'id_department', 'id');
    }

    public static function createNew(CreatableObject $creatableService): Model
    {
        return self::query()->create([
            'name' => $creatableService->getName(),
            'id_department' => $creatableService->getIdDepartment(),
            'duration' => $creatableService->getDuration(),
            'price' => $creatableService->getPrice(),
            'description' => $creatableService->getDescription(),
            'active' => true,
        ]);
    }

    /**
     * @throws Exception
     */
    public function updateModel(EditableService $newServiceData): void
    {
        $this->setName($newServiceData->getName());
        $this->setIdDepartment($newServiceData->getIdDepartment());
        $this->setDescription($newServiceData->getDescription());
        $this->setPrice($newServiceData->getPrice());
        $this->setDuration($newServiceData->getDuration());
        $this->setActive($newServiceData->isActive());

        if (!$this->save()) {
            throw new Exception("Hubo un error al actualizar el servicio");
        }
    }

    private function setName(string $name): void
    {
        $this->name = $name;
    }

    private function setIdDepartment(int $idDepartment): void
    {
        $this->id_department = $idDepartment;
    }

    private function setDescription(string $description): void
    {
        $this->description = $description;
    }

    private function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    private function setPrice(float $price): void
    {
        $this->price = $price;
    }

    private function setActive(bool $active): void
    {
        $this->active = $active;
    }
}
