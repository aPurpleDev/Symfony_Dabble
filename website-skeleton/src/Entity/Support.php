<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SupportRepository")
 */
class Support
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
    private $type_support;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LigneCommandes", mappedBy="lignecommande_support")
     */
    private $support_lignecommande;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produit", inversedBy="produit_support")
     */
    private $support_produit;

    public function __construct()
    {
        $this->support_lignecommande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeSupport(): ?string
    {
        return $this->type_support;
    }

    public function setTypeSupport(string $type_support): self
    {
        $this->type_support = $type_support;

        return $this;
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

    /**
     * @return Collection|LigneCommandes[]
     */
    public function getSupportLignecommande(): Collection
    {
        return $this->support_lignecommande;
    }

    public function addSupportLignecommande(LigneCommandes $supportLignecommande): self
    {
        if (!$this->support_lignecommande->contains($supportLignecommande)) {
            $this->support_lignecommande[] = $supportLignecommande;
            $supportLignecommande->setLignecommandeSupport($this);
        }

        return $this;
    }

    public function removeSupportLignecommande(LigneCommandes $supportLignecommande): self
    {
        if ($this->support_lignecommande->contains($supportLignecommande)) {
            $this->support_lignecommande->removeElement($supportLignecommande);
            // set the owning side to null (unless already changed)
            if ($supportLignecommande->getLignecommandeSupport() === $this) {
                $supportLignecommande->setLignecommandeSupport(null);
            }
        }

        return $this;
    }

    public function getSupportProduit(): ?Produit
    {
        return $this->support_produit;
    }

    public function setSupportProduit(?Produit $support_produit): self
    {
        $this->support_produit = $support_produit;

        return $this;
    }
}
