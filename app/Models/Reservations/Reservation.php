<?php


namespace App\Models\Reservations;


use App\Models\Services\Services;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;

    protected $table = "reservations";

    protected $fillable = [
        'hash',
        'id_user',
        'id_service',
        'name',
        'last_name',
        'phone',
        'email',
        'price',
        'appointment',
        'confirmation',
        'canceled',
    ];


    public function getId(): int
    {
        return $this->id;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function getUserId(): ?int
    {
        return $this->id_user;
    }

    public function hasUserId(): bool {
        return !is_null($this->getUserId());
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFullName(): string
    {
        return sprintf("%s %s", $this->getName(), $this->getLastName());
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getAppointment(): string
    {
        return $this->appointment;
    }

    public function isConfirmed(): bool
    {
        return $this->confirmation;
    }

    public function getServiceName(): ?string
    {
        return $this->service_name ?? $this->getService()?->getName();
    }

    public function isCanceled(): bool
    {
        return $this->canceled;
    }

    public function confirm(): void
    {
        if ($this->isConfirmed()) {
            throw new Exception("La reserva ya fue confirmada");
        }

        $this->confirmation = true;
        $this->save();
    }

    public function cancel(): void
    {
        if ($this->isConfirmed()) {
            throw new Exception("La reserva ya fue cancelada");
        }

        $this->canceled = true;
        $this->save();
    }


    public function getService(): ?Services
    {
        return $this->getServiceRelation;
    }

    public function getServiceRelation(): BelongsTo
    {
        return $this->belongsTo(Services::class, 'id_service', 'id');
    }

    public static function create(
        ?int $userId,
        int $serviceId,
        string $name,
        string $lastName,
        ?string $phone,
        string $email,
        string $appointment,
        float $price,
    ): self|Model
    {
        return self::query()->create([
            'hash' => substr(sha1(uniqid(mt_rand(), true)), 0, 40),
            'id_user' => $userId,
            'id_service' => $serviceId,
            'name' => $name,
            'last_name' => $lastName,
            'phone' => $phone,
            'email' => $email,
            'appointment' => $appointment,
            'price' => $price,
            'confirmation' => 0,
            'canceled' => 0,
        ]);
    }

    public function setNewAppointment(string $newAppointment): void
    {
        $this->appointment = $newAppointment;
    }
}
