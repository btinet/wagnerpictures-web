<?php

namespace App\Entity;

use App\Repository\SampleImageRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=SampleImageRepository::class)
 * @Vich\Uploadable
 */
class SampleImage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private int $isPublished;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="sample_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

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

    /**
     * @ORM\ManyToOne(targetEntity=Tag::class, inversedBy="sampleImages")
     */
    private $tags;

    /**
     * @ORM\ManyToMany(targetEntity=SampleLike::class, mappedBy="sample")
     */
    private $sampleLikes;

    /**
     * @ORM\OneToMany(targetEntity=SampleComment::class, mappedBy="sampleImage")
     */
    private $sampleComments;

    public function __construct()
    {
        $this->sampleLikes = new ArrayCollection();
        $this->sampleComments = new ArrayCollection();
    }


    public function __toString()
    {
        return $this->title ?? 'neu';
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getIsPublished()
    {
        return $this->isPublished;
    }


    public function setIsPublished($isPublished): void
    {
        $this->isPublished = $isPublished;
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



    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updated = new DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getTags(): ?Tag
    {
        return $this->tags;
    }

    public function setTags(?Tag $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return Collection|SampleLike[]
     */
    public function getSampleLikes(): Collection
    {
        return $this->sampleLikes;
    }

    public function addSampleLike(SampleLike $sampleLike): self
    {
        if (!$this->sampleLikes->contains($sampleLike)) {
            $this->sampleLikes[] = $sampleLike;
            $sampleLike->addSample($this);
        }

        return $this;
    }

    public function removeSampleLike(SampleLike $sampleLike): self
    {
        if ($this->sampleLikes->removeElement($sampleLike)) {
            $sampleLike->removeSample($this);
        }

        return $this;
    }

    /**
     * @return Collection|SampleComment[]
     */
    public function getSampleComments(): Collection
    {
        return $this->sampleComments;
    }

    public function addSampleComment(SampleComment $sampleComment): self
    {
        if (!$this->sampleComments->contains($sampleComment)) {
            $this->sampleComments[] = $sampleComment;
            $sampleComment->setSampleImage($this);
        }

        return $this;
    }

    public function removeSampleComment(SampleComment $sampleComment): self
    {
        if ($this->sampleComments->removeElement($sampleComment)) {
            // set the owning side to null (unless already changed)
            if ($sampleComment->getSampleImage() === $this) {
                $sampleComment->setSampleImage(null);
            }
        }

        return $this;
    }

}