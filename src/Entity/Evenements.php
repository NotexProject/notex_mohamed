<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenements
 *
 * @ORM\Table(name="evenements")
 * @ORM\Entity
 */
class Evenements
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_event", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_responsable", type="string", length=255, nullable=false)
     */
    private $nomResponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_event", type="string", length=255, nullable=false)
     */
    private $nomEvent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_event", type="date", nullable=false)
     */
    private $dateEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="category_event", type="string", length=255, nullable=false)
     */
    private $categoryEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="localisation_event", type="string", length=255, nullable=false)
     */
    private $localisationEvent;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_places", type="integer", nullable=false)
     */
    private $nbrPlaces;

    /**
     * @var int
     *
     * @ORM\Column(name="total_frais", type="integer", nullable=false)
     */
    private $totalFrais;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    public function getIdEvent(): ?int
    {
        return $this->idEvent;
    }

    public function getNomResponsable(): ?string
    {
        return $this->nomResponsable;
    }

    public function setNomResponsable(string $nomResponsable): self
    {
        $this->nomResponsable = $nomResponsable;

        return $this;
    }

    public function getNomEvent(): ?string
    {
        return $this->nomEvent;
    }

    public function setNomEvent(string $nomEvent): self
    {
        $this->nomEvent = $nomEvent;

        return $this;
    }

    public function getDateEvent(): ?\DateTimeInterface
    {
        return $this->dateEvent;
    }

    public function setDateEvent(\DateTimeInterface $dateEvent): self
    {
        $this->dateEvent = $dateEvent;

        return $this;
    }

    public function getCategoryEvent(): ?string
    {
        return $this->categoryEvent;
    }

    public function setCategoryEvent(string $categoryEvent): self
    {
        $this->categoryEvent = $categoryEvent;

        return $this;
    }

    public function getLocalisationEvent(): ?string
    {
        return $this->localisationEvent;
    }

    public function setLocalisationEvent(string $localisationEvent): self
    {
        $this->localisationEvent = $localisationEvent;

        return $this;
    }

    public function getNbrPlaces(): ?int
    {
        return $this->nbrPlaces;
    }

    public function setNbrPlaces(int $nbrPlaces): self
    {
        $this->nbrPlaces = $nbrPlaces;

        return $this;
    }

    public function getTotalFrais(): ?int
    {
        return $this->totalFrais;
    }

    public function setTotalFrais(int $totalFrais): self
    {
        $this->totalFrais = $totalFrais;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }


}
