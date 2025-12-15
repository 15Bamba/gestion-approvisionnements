<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $reference = null;

    #[ORM\Column]
    private ?float $prixUnitaire = null;

    /**
     * @var Collection<int, LigneApprovisionnement>
     */
    #[ORM\OneToMany(targetEntity: LigneApprovisionnement::class, mappedBy: 'article')]
    private Collection $ligneApprovisionnements;

    public function __construct()
    {
        $this->ligneApprovisionnements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
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

    public function getPrixUnitaire(): ?float
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(float $prixUnitaire): static
    {
        $this->prixUnitaire = $prixUnitaire;

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
            $ligneApprovisionnement->setArticle($this);
        }

        return $this;
    }

    public function removeLigneApprovisionnement(LigneApprovisionnement $ligneApprovisionnement): static
    {
        if ($this->ligneApprovisionnements->removeElement($ligneApprovisionnement)) {
            // set the owning side to null (unless already changed)
            if ($ligneApprovisionnement->getArticle() === $this) {
                $ligneApprovisionnement->setArticle(null);
            }
        }

        return $this;
    }
}
