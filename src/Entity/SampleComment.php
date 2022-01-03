<?php

namespace App\Entity;

use App\Repository\SampleCommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=SampleCommentRepository::class)
 */
class SampleComment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=SampleComment::class, inversedBy="sampleComments")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=SampleComment::class, mappedBy="parent")
     */
    private $sampleComments;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="sampleComments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=SampleImage::class, inversedBy="sampleComments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sampleImage;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;

    public function __construct()
    {
        $this->sampleComments = new ArrayCollection();
    }

    public function __toString()
    {
        $id = $this->getId();
        return "comment #{$id}";
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSampleComments(): Collection
    {
        return $this->sampleComments;
    }

    public function addSampleComment(self $sampleComment): self
    {
        if (!$this->sampleComments->contains($sampleComment)) {
            $this->sampleComments[] = $sampleComment;
            $sampleComment->setParent($this);
        }

        return $this;
    }

    public function removeSampleComment(self $sampleComment): self
    {
        if ($this->sampleComments->removeElement($sampleComment)) {
            // set the owning side to null (unless already changed)
            if ($sampleComment->getParent() === $this) {
                $sampleComment->setParent(null);
            }
        }

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

    public function getSampleImage(): ?SampleImage
    {
        return $this->sampleImage;
    }

    public function setSampleImage(?SampleImage $sampleImage): self
    {
        $this->sampleImage = $sampleImage;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created): void
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     */
    public function setUpdated($updated): void
    {
        $this->updated = $updated;
    }

}
