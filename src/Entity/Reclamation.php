<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="offreareclamer", columns={"offreareclamer"}), @ORM\Index(name="cinreclameur", columns={"cinreclameur"})})
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idreclamation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreclamation;

    /**
     * @var string
     * @Assert\NotNull(message="Il faut remplire ce chemp")
     * @ORM\Column(name="typereclamation", type="string", length=255, nullable=false)
     */
    private $typereclamation;

    /**
     * @var \DateTime
     * @ORM\Column(name="datereclamation", type="date", nullable=false)
     */
    private $datereclamation;

    /**
     * @var string
     * @Assert\NotNull(message="Il faut remplire ce chemp")
     * @ORM\Column(name="descriptionrecla", type="text", length=65535, nullable=false)
     */
    private $descriptionrecla;

    /**
     * @var string
     * @Assert\NotNull(message="Il faut remplire ce chemp")
     * @ORM\Column(name="comuniquer", type="text", length=65535, nullable=false)
     */
    private $comuniquer;

    /**
     * @var string
     * @Assert\Choice({"En cours", "Traiter", "Non Traiter"},
     *   message="Il faut remplire ce chemp"  )
     * @ORM\Column(name="etat", type="string", length=255, nullable=false)
     */
    private $etat;

    /**
     * @var \Compt
     *
     * @ORM\ManyToOne(targetEntity="Compt")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cinreclameur", referencedColumnName="idcompt")
     * })
     */
    private $cinreclameur;

    /**
     * @var \Offre
     *
     * @ORM\ManyToOne(targetEntity="Offre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="offreareclamer", referencedColumnName="idoffre")
     * })
     */
    private $offreareclamer;

    public function getIdreclamation(): ?int
    {
        return $this->idreclamation;
    }

    public function getTypereclamation(): ?string
    {
        return $this->typereclamation;
    }

    public function setTypereclamation(string $typereclamation): self
    {
        $this->typereclamation = $typereclamation;

        return $this;
    }

    public function getDatereclamation(): ?\DateTimeInterface
    {
        return $this->datereclamation;
    }

    public function setDatereclamation(\DateTimeInterface $datereclamation): self
    {
        $this->datereclamation = $datereclamation;

        return $this;
    }

    public function getDescriptionrecla(): ?string
    {
        return $this->descriptionrecla;
    }

    public function setDescriptionrecla(string $descriptionrecla): self
    {
        $this->descriptionrecla = $descriptionrecla;

        return $this;
    }

    public function getComuniquer(): ?string
    {
        return $this->comuniquer;
    }

    public function setComuniquer(string $comuniquer): self
    {
        $this->comuniquer = $comuniquer;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getCinreclameur(): ?Compt
    {
        return $this->cinreclameur;
    }

    public function setCinreclameur(?Compt $cinreclameur): self
    {
        $this->cinreclameur = $cinreclameur;

        return $this;
    }

    public function getOffreareclamer(): ?Offre
    {
        return $this->offreareclamer;
    }

    public function setOffreareclamer(?Offre $offreareclamer): self
    {
        $this->offreareclamer = $offreareclamer;

        return $this;
    }


}
