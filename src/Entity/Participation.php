<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="id_event", columns={"id_event"})})
 * @ORM\Entity
 */
class Participation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_part", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPart;

    /**
     * @var string
     *
     * @ORM\Column(name="personne_part", type="string", length=255, nullable=false)
     */
    private $personnePart;

    /**
     * @var int
     *
     * @ORM\Column(name="frais_part", type="integer", nullable=false)
     */
    private $fraisPart;

    /**
     * @var string
     *
     * @ORM\Column(name="type_part", type="string", length=255, nullable=false)
     */
    private $typePart;

    /**
     * @var \Evenements
     *
     * @ORM\ManyToOne(targetEntity="Evenements")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_event", referencedColumnName="id_event")
     * })
     */
    private $idEvent;

    public function getIdPart(): ?int
    {
        return $this->idPart;
    }

    public function getPersonnePart(): ?string
    {
        return $this->personnePart;
    }

    public function setPersonnePart(string $personnePart): self
    {
        $this->personnePart = $personnePart;

        return $this;
    }

    public function getFraisPart(): ?int
    {
        return $this->fraisPart;
    }

    public function setFraisPart(int $fraisPart): self
    {
        $this->fraisPart = $fraisPart;

        return $this;
    }

    public function getTypePart(): ?string
    {
        return $this->typePart;
    }

    public function setTypePart(string $typePart): self
    {
        $this->typePart = $typePart;

        return $this;
    }

    public function getIdEvent(): ?Evenements
    {
        return $this->idEvent;
    }

    public function setIdEvent(?Evenements $idEvent): self
    {
        $this->idEvent = $idEvent;

        return $this;
    }


}
