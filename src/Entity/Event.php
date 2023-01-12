<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\Column(length: 255)]
    private ?string $returnLocalisation = null;

    #[ORM\Column(length: 255)]
    private ?string $startCondition = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $returnCondition = null;

    #[ORM\Column(nullable: true)]
    private ?int $licenceNumber = null;

    #[ORM\Column(nullable: true)]
    private ?float $returnKm = null;

    #[ORM\Column(nullable: true)]
    private ?float $startKm = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    private ?User $userId = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    private ?Vehicle $vehicleId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getReturnLocalisation(): ?string
    {
        return $this->returnLocalisation;
    }

    public function setReturnLocalisation(string $returnLocalisation): self
    {
        $this->returnLocalisation = $returnLocalisation;

        return $this;
    }

    public function getStartCondition(): ?string
    {
        return $this->startCondition;
    }

    public function setStartCondition(string $startCondition): self
    {
        $this->startCondition = $startCondition;

        return $this;
    }

    public function getReturnCondition(): ?string
    {
        return $this->returnCondition;
    }

    public function setReturnCondition(?string $returnCondition): self
    {
        $this->returnCondition = $returnCondition;

        return $this;
    }

    public function getLicenceNumber(): ?int
    {
        return $this->licenceNumber;
    }

    public function setLicenceNumber(?int $licenceNumber): self
    {
        $this->licenceNumber = $licenceNumber;

        return $this;
    }

    public function getReturnKm(): ?float
    {
        return $this->returnKm;
    }

    public function setReturnKm(?float $returnKm): self
    {
        $this->returnKm = $returnKm;

        return $this;
    }

    public function getStartKm(): ?float
    {
        return $this->startKm;
    }

    public function setStartKm(?float $startKm): self
    {
        $this->startKm = $startKm;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getVehicleId(): ?Vehicle
    {
        return $this->vehicleId;
    }

    public function setVehicleId(?Vehicle $vehicleId): self
    {
        $this->vehicleId = $vehicleId;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }
}
