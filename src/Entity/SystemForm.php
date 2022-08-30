<?php

namespace App\Entity;

use App\Repository\SystemFormRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=SystemFormRepository::class)
 */
class SystemForm
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @Gedmo\Slug(fields={"formType"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

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
     * @ORM\Column(type="string", length=255)
     */
    private $formType;

    /**
     * @ORM\OneToMany(targetEntity=ProfileSetting::class, mappedBy="form")
     */
    private $profileSettings;

    public function __construct()
    {
        $this->profileSettings = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    public function getFormType(): ?string
    {
        return $this->formType;
    }

    public function setFormType(string $formType): self
    {
        $this->formType = $formType;

        return $this;
    }

    /**
     * @return Collection|ProfileSetting[]
     */
    public function getProfileSettings(): Collection
    {
        return $this->profileSettings;
    }

    public function addProfileSetting(ProfileSetting $profileSetting): self
    {
        if (!$this->profileSettings->contains($profileSetting)) {
            $this->profileSettings[] = $profileSetting;
            $profileSetting->setForm($this);
        }

        return $this;
    }

    public function removeProfileSetting(ProfileSetting $profileSetting): self
    {
        if ($this->profileSettings->removeElement($profileSetting)) {
            // set the owning side to null (unless already changed)
            if ($profileSetting->getForm() === $this) {
                $profileSetting->setForm(null);
            }
        }

        return $this;
    }
}
