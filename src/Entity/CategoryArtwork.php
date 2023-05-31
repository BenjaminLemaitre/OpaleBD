<?php

namespace App\Entity;

use App\Repository\CategoryArtworkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryArtworkRepository::class)]
class CategoryArtwork
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'categoryartwork', targetEntity: Oeuvres::class)]
    private Collection $oeuvres;

    #[ORM\Column(length: 255)]
    private ?string $illustration = null;

    #[ORM\ManyToMany(targetEntity: Auteurs::class, mappedBy: 'CategoryArtwork')]
    private Collection $auteurs;

    #[ORM\ManyToMany(targetEntity: Manif::class, mappedBy: 'categorie')]
    private Collection $manifs;

    public function __construct()
    {
        $this->oeuvres = new ArrayCollection();
        $this->auteurs = new ArrayCollection();
        $this->manifs = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIllustration(): ?string
    {
        return $this->illustration;
    }

    public function setIllustration(string $illustration): self
    {
        $this->illustration = $illustration;

        return $this;
    }

        /**
     * @return Collection<int, Oeuvres>
     */
    public function getOeuvres(): Collection
    {
        return $this->oeuvres;
    }

    public function addOeuvre(Oeuvres $oeuvre): self
    {
        if (!$this->oeuvres->contains($oeuvre)) {
            $this->oeuvres->add($oeuvre);
            $oeuvre->setAuteur($this);
        }

        return $this;
    }

    public function removeOeuvre(Oeuvres $oeuvre): self
    {
        if ($this->oeuvres->removeElement($oeuvre)) {
            // set the owning side to null (unless already changed)
            if ($oeuvre->getAuteur() === $this) {
                $oeuvre->setAuteur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Auteurs>
     */
    public function getAuteurs(): Collection
    {
        return $this->auteurs;
    }

    public function addAuteur(Auteurs $auteur): self
    {
        if (!$this->auteurs->contains($auteur)) {
            $this->auteurs->add($auteur);
            $auteur->addCategoryArtwork($this);
        }

        return $this;
    }

    public function removeAuteur(Auteurs $auteur): self
    {
        if ($this->auteurs->removeElement($auteur)) {
            $auteur->removeCategoryArtwork($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Manif>
     */
    public function getManifs(): Collection
    {
        return $this->manifs;
    }

    public function addManif(Manif $manif): self
    {
        if (!$this->manifs->contains($manif)) {
            $this->manifs->add($manif);
            $manif->addCategorie($this);
        }

        return $this;
    }

    public function removeManif(Manif $manif): self
    {
        if ($this->manifs->removeElement($manif)) {
            $manif->removeCategorie($this);
        }

        return $this;
    }

}
