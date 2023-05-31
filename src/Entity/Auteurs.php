<?php

namespace App\Entity;

use App\Repository\AuteursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuteursRepository::class)]
class Auteurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $illustration = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'auteur', targetEntity: Oeuvres::class)]
    private Collection $oeuvres;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\Column(length: 255)]
    private ?string $jobs = null;

    #[ORM\OneToMany(mappedBy: 'auteur', targetEntity: Series::class)]
    private Collection $series;

    #[ORM\ManyToMany(targetEntity: CategoryArtwork::class, inversedBy: 'auteurs')]
    private Collection $CategoryArtwork;

    #[ORM\ManyToMany(targetEntity: Manif::class, mappedBy: 'auteur')]
    private Collection $intervenants;

    public function __construct()
    {
        $this->oeuvres = new ArrayCollection();
        $this->series = new ArrayCollection();
        $this->CategoryArtwork = new ArrayCollection();
        $this->intervenants = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getJobs(): ?string
    {
        return $this->jobs;
    }

    public function setJobs(string $jobs): self
    {
        $this->jobs = $jobs;

        return $this;
    }

    /**
     * @return Collection<int, CategoryArtwork>
     */
    public function getCategoryArtwork(): Collection
    {
        return $this->CategoryArtwork;
    }

    public function addCategoryArtwork(CategoryArtwork $categoryArtwork): self
    {
        if (!$this->CategoryArtwork->contains($categoryArtwork)) {
            $this->CategoryArtwork->add($categoryArtwork);
        }

        return $this;
    }

    public function removeCategoryArtwork(CategoryArtwork $categoryArtwork): self
    {
        $this->CategoryArtwork->removeElement($categoryArtwork);

        return $this;
    }

    /**
     * @return Collection<int, Manif>
     */
    public function getIntervenants(): Collection
    {
        return $this->intervenants;
    }

    public function addIntervenant(Manif $intervenant): self
    {
        if (!$this->intervenants->contains($intervenant)) {
            $this->intervenants->add($intervenant);
            $intervenant->addAuteur($this);
        }

        return $this;
    }

    public function removeIntervenant(Manif $intervenant): self
    {
        if ($this->intervenants->removeElement($intervenant)) {
            $intervenant->removeAuteur($this);
        }

        return $this;
    }

}
