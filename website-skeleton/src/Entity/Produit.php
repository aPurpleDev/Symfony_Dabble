<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="date")
     */
    private $date_production;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $presentation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artist", inversedBy="artiste_produit")
     */
    private $produit_artiste;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Support", mappedBy="support_produit")
     */
    private $produit_support;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Streaming", mappedBy="streamingxproduit")
     */
    private $streamings;

    public function __construct()
    {
        $this->produit_support = new ArrayCollection();
        $this->streamings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDateProduction(): ?\DateTimeInterface
    {
        return $this->date_production;
    }

    public function setDateProduction(\DateTimeInterface $date_production): self
    {
        $this->date_production = $date_production;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getProduitArtiste(): ?Artist
    {
        return $this->produit_artiste;
    }

    public function setProduitArtiste(?Artist $produit_artiste): self
    {
        $this->produit_artiste = $produit_artiste;

        return $this;
    }

    /**
     * @return Collection|Support[]
     */
    public function getProduitSupport(): Collection
    {
        return $this->produit_support;
    }

    public function addProduitSupport(Support $produitSupport): self
    {
        if (!$this->produit_support->contains($produitSupport)) {
            $this->produit_support[] = $produitSupport;
            $produitSupport->setSupportProduit($this);
        }

        return $this;
    }

    public function removeProduitSupport(Support $produitSupport): self
    {
        if ($this->produit_support->contains($produitSupport)) {
            $this->produit_support->removeElement($produitSupport);
            // set the owning side to null (unless already changed)
            if ($produitSupport->getSupportProduit() === $this) {
                $produitSupport->setSupportProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Streaming[]
     */
    public function getStreamings(): Collection
    {
        return $this->streamings;
    }

    public function addStreaming(Streaming $streaming): self
    {
        if (!$this->streamings->contains($streaming)) {
            $this->streamings[] = $streaming;
            $streaming->addStreamingxproduit($this);
        }

        return $this;
    }

    public function removeStreaming(Streaming $streaming): self
    {
        if ($this->streamings->contains($streaming)) {
            $this->streamings->removeElement($streaming);
            $streaming->removeStreamingxproduit($this);
        }

        return $this;
    }
}
