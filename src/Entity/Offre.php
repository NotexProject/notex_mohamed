<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Offre
 *
 * @ORM\Table(name="offre", indexes={@ORM\Index(name="foregnky", columns={"cincreateuroffre"})})
 * @ORM\Entity
 */
class Offre
{
    /**
     * @var int
     *
     * @ORM\Column(name="idoffre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idoffre;

    /**
     * @var string
     * @Assert\NotNull(message="Il faut remplire ce chemp")
     * @ORM\Column(name="nomoffre", type="string", length=255, nullable=false)
     * @Assert\Length(
     *      min = 5,
     *      max = 100,
     *      minMessage = "Votre titre dois contenir plus que 5 characters",
     *      maxMessage = "Votre titre dois contenir moins de 100"
     * )
     */
    private $nomoffre;

    /**
     * @var \DateTime
     * @Assert\GreaterThanOrEqual(value="today",
     * message="la date doit etre superieur ou egale a la date de aujourd'hui")
     * @ORM\Column(name="datedebut", type="date", nullable=false)
     */
    private $datedebut;

    /**
     * @var \DateTime
     * @Assert\Expression(
     *     "this.getDatefin() > this.getDatedebut()",
     *     message="la date fin d'offre doit etre superieur a la date debut"
     * )
     * @ORM\Column(name="datefin", type="date", nullable=false)
     */
    private $datefin;

    /**
     * @var string
     * @Assert\NotBlank(message="Il faut remplire ce chemp")
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="imgsrc", type="string", length=255, nullable=false)
     */
    private $imgsrc;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=255, nullable=false)
     */
    private $couleur;

    /**
     * @var string
     *
     * @ORM\Column(name="typeoffre", type="string", length=255, nullable=false)
     */
    private $typeoffre;

    /**
     * @var \Compt
     *
     * @ORM\ManyToOne(targetEntity="Compt")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cincreateuroffre", referencedColumnName="idcompt")
     * })
     */
    private $cincreateuroffre;

    public function getIdoffre(): ?int
    {
        return $this->idoffre;
    }

    public function getNomoffre(): ?string
    {
        return $this->nomoffre;
    }

    public function setNomoffre(string $nomoffre): self
    {
        $this->nomoffre = $nomoffre;

        return $this;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(\DateTimeInterface $datefin): self
    {
        $this->datefin = $datefin;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImgsrc(): ?string
    {
        return $this->imgsrc;
    }

    public function setImgsrc(string $imgsrc): self
    {
        $this->imgsrc = $imgsrc;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getTypeoffre(): ?string
    {
        return $this->typeoffre;
    }

    public function setTypeoffre(string $typeoffre): self
    {
        $this->typeoffre = $typeoffre;

        return $this;
    }

    public function getCincreateuroffre(): ?Compt
    {
        return $this->cincreateuroffre;
    }

    public function setCincreateuroffre(?Compt $cincreateuroffre): self
    {
        $this->cincreateuroffre = $cincreateuroffre;

        return $this;
    }


}
