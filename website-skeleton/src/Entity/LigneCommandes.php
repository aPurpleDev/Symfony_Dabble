<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LigneCommandesRepository")
 */
class LigneCommandes
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
    private $no_commande;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Commande", inversedBy="ligneCommandes")
     */
    private $lignecommande_commande;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Support", inversedBy="support_lignecommande")
     */
    private $lignecommande_support;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoCommande(): ?int
    {
        return $this->no_commande;
    }

    public function setNoCommande(int $no_commande): self
    {
        $this->no_commande = $no_commande;

        return $this;
    }

    public function getLignecommandeCommande(): ?Commande
    {
        return $this->lignecommande_commande;
    }

    public function setLignecommandeCommande(?Commande $lignecommande_commande): self
    {
        $this->lignecommande_commande = $lignecommande_commande;

        return $this;
    }

    public function getLignecommandeSupport(): ?Support
    {
        return $this->lignecommande_support;
    }

    public function setLignecommandeSupport(?Support $lignecommande_support): self
    {
        $this->lignecommande_support = $lignecommande_support;

        return $this;
    }
}
