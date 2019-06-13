<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * MumLocations
 *
 * @ORM\Table(name="mum_locations")
 * @ORM\Entity
 * @ApiResource(
 *     normalizationContext={"groups"={"default"}},
 *     denormalizationContext={"groups"={"default"}}
 * )
 */
class MumLocations
{
    /**
     * @var float
     * @Groups({"mum_location", "default"})
     * @ORM\Column(name="latitude", type="float", length=20, nullable=false, options={"default"="0.0"})
     */
    private $latitude = 0.0;

    /**
     * @var float
     * @Groups({"mum_location", "default"})
     * @ORM\Column(name="longitude", type="float", length=20, nullable=false, options={"default"="0.0"})
     */
    private $longitude = 0.0;

    /**
     * @ORM\Id
     * @Groups({"default"})
     * @ORM\OneToOne(targetEntity="Mums", inversedBy="mumLocation", fetch="EAGER")
     * @ORM\JoinColumn(name="mum_id", referencedColumnName="mum_id", nullable=false)
     * @var Mums
     */
    protected $mum;

    /**
     * @Groups({"default"})
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->mum->getId();
    }

    /**
     * @return Mums|null
     */
    public function getMum(): ?Mums
    {
        return $this->mum;
    }

    /**
     * @Groups({"default"})
     * @return string|null
     */
    public function getMumId(): ?string
    {
        return $this->getId();
    }

    public function setMum(Mums $mum): self
    {
        $this->mum = $mum;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return (float)$this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return (float)$this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getGeoPoint(): string
    {
        return $this->latitude.','.$this->longitude;
    }


}
