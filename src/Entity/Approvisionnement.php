<?php

namespace App\Entity;

use App\Repository\ApprovisionnementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApprovisionnementRepository::class)]
class Approvisionnement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    private ?\DateTimeImmutable $dateCreation = null;

    // src/Entity/Approvisionnement.php (Propriété)
    #[ORM\ManyToOne(targetEntity: Fournisseur::class)]
    private ?Fournisseur $fournisseur; // Ou peut-être $leFournisseur, $fourn, etc.

    /**
     * @var Collection<int, LigneApprovisionnement>
     */
    #[ORM\OneToMany(targetEntity: LigneApprovisionnement::class, mappedBy: 'approvisionnement')]
    private Collection $ligneApprovisionnements;

    // src/Entity/Approvisionnement.php (Setter)
    public function setFournisseur(?Fournisseur $fournisseur): static
    {
        $this->fournisseur = $fournisseur;
        return $this;
    }

    public function __construct()
    {
        $this->ligneApprovisionnements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }
    private float $montantTotal;

// ...existing code...

// ...existing code...

    private string $statut;

    // ...existing code...

    

   

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;
        return $this;
    }

    public function getStatut(): string
    {
        return $this->statut;
    }
    

// ...existing code...
    public function setMontantTotal(float $montantTotal): self
    {
        $this->montantTotal = $montantTotal;
        return $this;
    }

    public function getMontantTotal(): float
    {
        return $this->montantTotal;
    }

    public function getDateCreation(): ?\DateTimeImmutable
    {
        return $this->dateCreation;
    }
    public function setDateCreation(\DateTimeImmutable $dateCreation): static
    {
        $this->dateCreation = $dateCreation; // Assurez-vous que le nom de la propriété correspond
        return $this;
    }
    /**
     * @return Collection<int, LigneApprovisionnement>
     */
    public function getLigneApprovisionnements(): Collection
    {
        return $this->ligneApprovisionnements;
    }

    public function addLigneApprovisionnement(LigneApprovisionnement $ligneApprovisionnement): static
    {
        if (!$this->ligneApprovisionnements->contains($ligneApprovisionnement)) {
            $this->ligneApprovisionnements->add($ligneApprovisionnement);
            $ligneApprovisionnement->setApprovisionnement($this);
        }

        return $this;
    }

    public function removeLigneApprovisionnement(LigneApprovisionnement $ligneApprovisionnement): static
    {
        if ($this->ligneApprovisionnements->removeElement($ligneApprovisionnement)) {
            // set the owning side to null (unless already changed)
            if ($ligneApprovisionnement->getApprovisionnement() === $this) {
                $ligneApprovisionnement->setApprovisionnement(null);
            }
        }

        return $this;
    }
}
