<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
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
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code_postal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="client_id", cascade={"persist", "remove"})
     */
    private $user_client_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="relation")
     */
    private $commandes_relation;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Actualite", mappedBy="client_abonne")
     */
    private $abonnement_client;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Streaming", mappedBy="streaming_produit")
     */
    private $client_streaming;

    public function __construct()
    {
        $this->commandes_relation = new ArrayCollection();
        $this->abonnement_client = new ArrayCollection();
        $this->client_streaming = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getAddresse(): ?string
    {
        return $this->addresse;
    }

    public function setAddresse(string $addresse): self
    {
        $this->addresse = $addresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getUserClientId(): ?User
    {
        return $this->user_client_id;
    }

    public function setUserClientId(?User $user_client_id): self
    {
        $this->user_client_id = $user_client_id;

        // set (or unset) the owning side of the relation if necessary
        $newClient_id = $user_client_id === null ? null : $this;
        if ($newClient_id !== $user_client_id->getClientId()) {
            $user_client_id->setClientId($newClient_id);
        }

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandesRelation(): Collection
    {
        return $this->commandes_relation;
    }

    public function addCommandesRelation(Commande $commandesRelation): self
    {
        if (!$this->commandes_relation->contains($commandesRelation)) {
            $this->commandes_relation[] = $commandesRelation;
            $commandesRelation->setRelation($this);
        }

        return $this;
    }

    public function removeCommandesRelation(Commande $commandesRelation): self
    {
        if ($this->commandes_relation->contains($commandesRelation)) {
            $this->commandes_relation->removeElement($commandesRelation);
            // set the owning side to null (unless already changed)
            if ($commandesRelation->getRelation() === $this) {
                $commandesRelation->setRelation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Actualite[]
     */
    public function getAbonnementClient(): Collection
    {
        return $this->abonnement_client;
    }

    public function addAbonnementClient(Actualite $abonnementClient): self
    {
        if (!$this->abonnement_client->contains($abonnementClient)) {
            $this->abonnement_client[] = $abonnementClient;
            $abonnementClient->addClientAbonne($this);
        }

        return $this;
    }

    public function removeAbonnementClient(Actualite $abonnementClient): self
    {
        if ($this->abonnement_client->contains($abonnementClient)) {
            $this->abonnement_client->removeElement($abonnementClient);
            $abonnementClient->removeClientAbonne($this);
        }

        return $this;
    }

    /**
     * @return Collection|Streaming[]
     */
    public function getClientStreaming(): Collection
    {
        return $this->client_streaming;
    }

    public function addClientStreaming(Streaming $clientStreaming): self
    {
        if (!$this->client_streaming->contains($clientStreaming)) {
            $this->client_streaming[] = $clientStreaming;
            $clientStreaming->addStreamingProduit($this);
        }

        return $this;
    }

    public function removeClientStreaming(Streaming $clientStreaming): self
    {
        if ($this->client_streaming->contains($clientStreaming)) {
            $this->client_streaming->removeElement($clientStreaming);
            $clientStreaming->removeStreamingProduit($this);
        }

        return $this;
    }
}
