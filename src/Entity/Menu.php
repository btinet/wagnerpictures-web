<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=MenuRepository::class)
 */
class Menu
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
    private ?string $title;

    /**
     * @Gedmo\Slug(fields={"title"})
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
     * @var Collection
     * @ORM\OneToMany(targetEntity=MenuEntry::class, mappedBy="type")
     */
    private $menuEntries;

    public function __construct()
    {
        $this->menuEntries = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitle();
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

    /**
     * @return Collection
     */
    public function getMenuEntries(): Collection
    {
        return $this->menuEntries;
    }

    public function addMenuEntry(MenuEntry $menuEntry): self
    {
        if (!$this->menuEntries->contains($menuEntry)) {
            $this->menuEntries[] = $menuEntry;
            $menuEntry->setType($this);
        }

        return $this;
    }

    public function removeMenuEntry(MenuEntry $menuEntry): self
    {
        if ($this->menuEntries->removeElement($menuEntry)) {
            // set the owning side to null (unless already changed)
            if ($menuEntry->getType() === $this) {
                $menuEntry->setType(null);
            }
        }

        return $this;
    }

}
