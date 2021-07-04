<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EquipmentRepository::class)
 */
class Equipment
{
    const STATUS_INSATION = 'inStation';
    const STATUS_INTRANSIT = 'inTransit';

    const TYPE_CHAIR = 'chair';
    const TYPE_BED = 'bed';
    const TYPE_DESK = 'desk';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('chair', 'bed', 'desk')")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Station::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $originStation;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('inStation', 'inTransit')")
     */
    private $status;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getOriginStation(): ?Station
    {
        return $this->originStation;
    }

    public function setOriginStation(Station $originStation): self
    {
        $this->originStation = $originStation;

        return $this;
    }
}
