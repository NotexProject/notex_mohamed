<?php

namespace App\Entity;
use App\Repository\ParticipationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


use Symfony\Component\Validator\Constraints as Assert;

/**
 * Participation
 *
 * @ORM\Table(name="participation")
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
     * @ORM\Column(name="prenom_part", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     *  @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private $prenomPart;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_part", type="string", length=255, nullable=false)
     */
    private $nomPart;

    /**
     * @var string
     *
     * @ORM\Column(name="type_part", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     *  @Assert\Length(
     *      min = 2,
     *      max = 20,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private $typePart;

    /**
     * @var \Evenements
     *
     * @ORM\ManyToOne(targetEntity="Evenements")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_event", referencedColumnName="id_event")
     * })
     */
    private $idEvent;





    public function getIdPart(): ?int
    {
        return $this->idPart;
    }

    public function getPrenomPart(): ?string
    {
        return $this->prenomPart;
    }

    public function setPrenomPart(string $prenomPart): self
    {
        $this->prenomPart = $prenomPart;

        return $this;
    }

    public function getNomPart(): ?string
    {
        return $this->nomPart;
    }

    public function setNomPart(string $nomPart): self
    {
        $this->nomPart = $nomPart;

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
