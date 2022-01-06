<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Embedded;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private ?string $email;

    /** @Embedded(class = "App\Entity\PrivateName") */
    private $privatName;

    /** @Embedded(class = "App\Entity\CompanyName") */
    private $companyName;

    /** @Embedded(class = "App\Entity\Address") */
    private $address;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $locale;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isVerified = false;

    /**
     * @ORM\ManyToMany(targetEntity=SampleLike::class, mappedBy="user")
     */
    private $sampleLikes;

    /**
     * @ORM\OneToMany(targetEntity=SampleComment::class, mappedBy="user")
     */
    private $sampleComments;

    /**
     * @ORM\OneToMany(targetEntity=Application::class, mappedBy="user")
     */
    private $applications;

    public function __construct()
    {
        $this->sampleLikes = new ArrayCollection();
        $this->sampleComments = new ArrayCollection();
        $this->applications = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getUserIdentifier();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


    public function getPrivatName()
    {
        return $this->privatName;
    }


    public function setPrivatName($privatName): void
    {
        $this->privatName = $privatName;
    }


    public function getCompanyName()
    {
        return $this->companyName;
    }


    public function setCompanyName($companyName): void
    {
        $this->companyName = $companyName;
    }


    public function getAddress()
    {
        return $this->address;
    }


    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(?string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

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
            $sampleLike->addUser($this);
        }

        return $this;
    }

    public function removeSampleLike(SampleLike $sampleLike): self
    {
        if ($this->sampleLikes->removeElement($sampleLike)) {
            $sampleLike->removeUser($this);
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
            $sampleComment->setUser($this);
        }

        return $this;
    }

    public function removeSampleComment(SampleComment $sampleComment): self
    {
        if ($this->sampleComments->removeElement($sampleComment)) {
            // set the owning side to null (unless already changed)
            if ($sampleComment->getUser() === $this) {
                $sampleComment->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Application[]
     */
    public function getApplications(): Collection
    {
        return $this->applications;
    }

    public function addApplication(Application $application): self
    {
        if (!$this->applications->contains($application)) {
            $this->applications[] = $application;
            $application->setUser($this);
        }

        return $this;
    }

    public function removeApplication(Application $application): self
    {
        if ($this->applications->removeElement($application)) {
            // set the owning side to null (unless already changed)
            if ($application->getUser() === $this) {
                $application->setUser(null);
            }
        }

        return $this;
    }
}
