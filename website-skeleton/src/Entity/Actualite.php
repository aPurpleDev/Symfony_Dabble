<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActualiteRepository")
 */
class Actualite
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
    private $thematique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenu;

    /**
     * @ORM\Column(type="date")
     */
    private $date_publication;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Client", inversedBy="abonnement_client")
     */
    private $client_abonne;

    public function __construct()
    {
        $this->client_abonne = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getThematique(): ?string
    {
        return $this->thematique;
    }

    public function setThematique(string $thematique): self
    {
        $this->thematique = $thematique;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->date_publication;
    }

    public function setDatePublication(\DateTimeInterface $date_publication): self
    {
        $this->date_publication = $date_publication;

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getClientAbonne(): Collection
    {
        return $this->client_abonne;
    }

    public function addClientAbonne(Client $clientAbonne): self
    {
        if (!$this->client_abonne->contains($clientAbonne)) {
            $this->client_abonne[] = $clientAbonne;
        }

        return $this;
    }

    public function removeClientAbonne(Client $clientAbonne): self
    {
        if ($this->client_abonne->contains($clientAbonne)) {
            $this->client_abonne->removeElement($clientAbonne);
        }

        return $this;
    }
}
