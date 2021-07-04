<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Van::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $van;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;


    /**
     * @ORM\ManyToOne(targetEntity=Station::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $startStation;

    /**
     * @ORM\ManyToOne(targetEntity=Station::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $endStation;

    /**
     * @var Collection|Equipment[]
     *
     * @ORM\ManyToMany(targetEntity="Equipment")
     */
    private $equipments;

    public function __construct()
    {
        $this->equipments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVan(): ?Van
    {
        return $this->van;
    }

    public function setVan(Van $van): self
    {
        $this->van = $van;

        return $this;
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

    public function getStartStation(): ?Station
    {
        return $this->startStation;
    }

    public function setStartStation(Station $startStation): self
    {
        $this->startStation = $startStation;

        return $this;
    }

    public function getEndStation(): ?Station
    {
        return $this->endStation;
    }

    public function setEndStation(Station $endStation): self
    {
        $this->endStation = $endStation;

        return $this;
    }

    /**
     * @return Equipment[]|Collection
     */
    public function getEquipments()
    {
        return $this->equipments;
    }

    /**
     * @param Equipment[]|Collection $equipments
     */
    public function setEquipments($equipments): void
    {
        $this->equipments = $equipments;
    }

}
