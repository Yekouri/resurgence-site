<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfileRepository")
 */
class Profile
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $race;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $class;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $spec;

    /**
     * @ORM\Column(type="boolean")
     */
    private $pvp;

    /**
     * @ORM\Column(type="integer")
     */
    private $currentPvpRank;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalPvpRank;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $professionA;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $professionB;

    /**
     * @ORM\Column(type="date")
     */
    private $joinDate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Attunement", inversedBy="profiles")
     */
    private $attunements;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rank", inversedBy="profiles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rank;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="profiles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct()
    {
        $this->attunements = new ArrayCollection();
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

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getSpec(): ?string
    {
        return $this->spec;
    }

    public function setSpec(string $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function getPvp(): ?bool
    {
        return $this->pvp;
    }

    public function setPvp(bool $pvp): self
    {
        $this->pvp = $pvp;

        return $this;
    }

    public function getCurrentPvpRank(): ?int
    {
        return $this->currentPvpRank;
    }

    public function setCurrentPvpRank(int $currentPvpRank): self
    {
        $this->currentPvpRank = $currentPvpRank;

        return $this;
    }

    public function getGoalPvpRank(): ?int
    {
        return $this->goalPvpRank;
    }

    public function setGoalPvpRank(?int $goalPvpRank): self
    {
        $this->goalPvpRank = $goalPvpRank;

        return $this;
    }

    public function getProfessionA(): ?string
    {
        return $this->professionA;
    }

    public function setProfessionA(string $professionA): self
    {
        $this->professionA = $professionA;

        return $this;
    }

    public function getProfessionB(): ?string
    {
        return $this->professionB;
    }

    public function setProfessionB(string $professionB): self
    {
        $this->professionB = $professionB;

        return $this;
    }

    public function getJoinDate(): ?\DateTimeInterface
    {
        return $this->joinDate;
    }

    public function setJoinDate(\DateTimeInterface $joinDate): self
    {
        $this->joinDate = $joinDate;

        return $this;
    }

    /**
     * @return Collection|Attunements[]
     */
    public function getAttunements(): Collection
    {
        return $this->attunements;
    }

    public function addAttunement(Attunement $attunement): self
    {
        if (!$this->attunements->contains($attunement)) {
            $this->attunements[] = $attunement;
        }

        return $this;
    }

    public function removeAttunement(Attunement $attunement): self
    {
        if ($this->attunements->contains($attunement)) {
            $this->attunements->removeElement($attunement);
        }

        return $this;
    }

    public function getRank(): ?Rank
    {
        return $this->rank;
    }

    public function setRank(?Rank $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
