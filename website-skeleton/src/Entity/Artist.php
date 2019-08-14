<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtistRepository")
 */
class Artist
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $style;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $presentation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Evenement", inversedBy="artist_id")
     */
    private $evenement;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Produit", mappedBy="produit_artiste")
     */
    private $artiste_produit;

    public function __construct()
    {
        $this->artiste_produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getStyle(): ?string
    {
        return $this->style;
    }

    public function setStyle(?string $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(?string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenement $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getArtisteProduit(): Collection
    {
        return $this->artiste_produit;
    }

    public function addArtisteProduit(Produit $artisteProduit): self
    {
        if (!$this->artiste_produit->contains($artisteProduit)) {
            $this->artiste_produit[] = $artisteProduit;
            $artisteProduit->setProduitArtiste($this);
        }

        return $this;
    }

    public function removeArtisteProduit(Produit $artisteProduit): self
    {
        if ($this->artiste_produit->contains($artisteProduit)) {
            $this->artiste_produit->removeElement($artisteProduit);
            // set the owning side to null (unless already changed)
            if ($artisteProduit->getProduitArtiste() === $this) {
                $artisteProduit->setProduitArtiste(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return 'Nom de l\'artiste: ' . $this->nom . ' et ID de l\'artiste: ' . $this->id;
    }
}
