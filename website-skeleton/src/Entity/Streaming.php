<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StreamingRepository")
 */
class Streaming
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre_morceau;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $qualite;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Client", inversedBy="client_streaming")
     */
    private $streaming_produit;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Produit", inversedBy="streamings")
     */
    private $streamingxproduit;

    public function __construct()
    {
        $this->streaming_produit = new ArrayCollection();
        $this->streamingxproduit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getTitreMorceau(): ?string
    {
        return $this->titre_morceau;
    }

    public function setTitreMorceau(string $titre_morceau): self
    {
        $this->titre_morceau = $titre_morceau;

        return $this;
    }

    public function getQualite(): ?string
    {
        return $this->qualite;
    }

    public function setQualite(string $qualite): self
    {
        $this->qualite = $qualite;

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getStreamingProduit(): Collection
    {
        return $this->streaming_produit;
    }

    public function addStreamingProduit(Client $streamingProduit): self
    {
        if (!$this->streaming_produit->contains($streamingProduit)) {
            $this->streaming_produit[] = $streamingProduit;
        }

        return $this;
    }

    public function removeStreamingProduit(Client $streamingProduit): self
    {
        if ($this->streaming_produit->contains($streamingProduit)) {
            $this->streaming_produit->removeElement($streamingProduit);
        }

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getStreamingxproduit(): Collection
    {
        return $this->streamingxproduit;
    }

    public function addStreamingxproduit(Produit $streamingxproduit): self
    {
        if (!$this->streamingxproduit->contains($streamingxproduit)) {
            $this->streamingxproduit[] = $streamingxproduit;
        }

        return $this;
    }

    public function removeStreamingxproduit(Produit $streamingxproduit): self
    {
        if ($this->streamingxproduit->contains($streamingxproduit)) {
            $this->streamingxproduit->removeElement($streamingxproduit);
        }

        return $this;
    }
}
