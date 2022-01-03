<?php

namespace App\Entity;

use App\Repository\SampleLikeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SampleLikeRepository::class)
 */
class SampleLike
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=SampleImage::class, inversedBy="sampleLikes")
     */
    private $sample;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="sampleLikes")
     */
    private $user;


    public function __construct()
    {
        $this->sample = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|SampleImage[]
     */
    public function getSample(): Collection
    {
        return $this->sample;
    }

    public function addSample (SampleImage $sample): self
    {
        if (!$this->sample->contains($sample)) {
            $this->sample[] = $sample;
        }

        return $this;
    }

    public function removeSample (SampleImage $sample): self
    {
        $this->sample->removeElement($sample);

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }
}
