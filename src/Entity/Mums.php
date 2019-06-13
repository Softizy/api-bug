<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Serializer\Filter\GroupFilter;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
/**
 * Mums
 *
 * @ORM\Table(name="mums")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ApiResource(
 *     normalizationContext={"groups"={"mums"}},
 *     denormalizationContext={"groups"={"mums"}}
 * )
 */
class Mums
{
    /**
     * @var string
     * @Groups({"mums"})
     * @ApiProperty(identifier=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(name="mum_id", type="string", length=32, nullable=false, options={"default"=""})
     */
    private $mumId = '';

    /**
     * @ORM\OneToOne(targetEntity="MumLocations", mappedBy="mum", cascade={"persist", "remove"}, orphanRemoval=true, fetch="EAGER")
     * @var MumLocations
     */
    private $mumLocation;

    public function __construct()
    {
    }

    public function __toString()
    {
        return $this->getId();
    }

    public function getMumLocation(): ?MumLocations
    {
        return $this->mumLocation;
    }

    public function getLocation(): ?MumLocations
    {
        return $this->mumLocation;
    }

    public function setMumLocation(MumLocations $location): self
    {
        return $this->setLocation($location);
    }

    public function setLocation(MumLocations $location): self
    {
        if ($this->mumLocation != null) {
            $this->mumLocation->setLatitude($location->getLatitude());
            $this->mumLocation->setLongitude($location->getLongitude());
        } else {
            $this->mumLocation = $location;
        }
        return $this;
    }

    public function getId(): ?string
    {
        return $this->mumId;
    }

    public function getMumId(): ?string
    {
        return $this->mumId;
    }

    public function setMumId(string $mumId): self
    {
        $this->mumId = $mumId;

        return $this;
    }

    /**
     * @ORM\PreFlush()
     */
    public function onPreFlush()
    {
        $this->onPrePersist();
    }

    /**
     * @ORM\PrePersist()
     */
    public function onPrePersist()
    {
        if ($this->mumLocation) {
            $this->mumLocation->setMum($this);
        }
    }

}
