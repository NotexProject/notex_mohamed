<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Abonnement
 *
 * @ORM\Table(name="abonnement")
 * @ORM\Entity
 */
class Abonnement
{
    /**
     * @var int
     *
     * @ORM\Column(name="ida", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ida;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 4,
     *      max = 20,
     *      minMessage = " must be at least {{ limit }} characters long",
     *      maxMessage = " cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(name="nomabonnement", type="string", length=255, nullable=false)
     */
    private $nomabonnement;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 4,
     *      max = 120,
     *      minMessage = " must be at least {{ limit }} characters long",
     *      maxMessage = " cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var int
     * @Assert\NotBlank
     * @Assert\Range(
     *      min = 1,
     *      max = 9999,
     *      notInRangeMessage = "You must be between {{ min }}cm and {{ max }}cm tall to enter",
     * )
     * @ORM\Column(name="price", type="integer", nullable=false)
     */
    private $price;

    /**
     * @var string|null
     * @Assert\NotBlank
     * @ORM\Column(name="image", type="string", length=255, nullable=true, options={"default"="NULL"})
     */
    private $image = 'NULL' ;

    public function getIda(): ?int
    {
        return $this->ida;
    }

    public function getNomabonnement(): ?string
    {
        return $this->nomabonnement;
    }

    public function setNomabonnement(string $nomabonnement): self
    {
        $this->nomabonnement = $nomabonnement;

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage( $image): self
    {
        $this->image = $image;

        return $this;
    }


}
