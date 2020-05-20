<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\UserRepository;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="integer")
     */
    private $postal_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Ranking::class, inversedBy="users")
     */
    private $ranking;

    /**
     * @ORM\Column(type="integer")
     */
    private $time_gauge;

    /**
     * @ORM\Column(type="integer")
     */
    private $total_time_service_given;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="users")
     */
    private $category_affinity;

    /**
     * @ORM\ManyToMany(targetEntity=SubCategory::class, inversedBy="users")
     */
    private $sub_cat_affinity;

    /**
     * @ORM\OneToMany(targetEntity=Contact::class, mappedBy="user")
     */
    private $contacts;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="user_from")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Mailbox::class, mappedBy="user_from")
     */
    private $mailboxes;

    /**
     * @ORM\OneToMany(targetEntity=Service::class, mappedBy="user")
     */
    private $services;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    public function __construct()
    {
        $this->category_affinity = new ArrayCollection();
        $this->sub_cat_affinity = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->mailboxes = new ArrayCollection();
        $this->services = new ArrayCollection();
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
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
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postal_code;
    }

    public function setPostalCode(int $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getRanking(): ?Ranking
    {
        return $this->ranking;
    }

    public function setRanking(?Ranking $ranking): self
    {
        $this->ranking = $ranking;

        return $this;
    }

    public function getTimeGauge(): ?int
    {
        return $this->time_gauge;
    }

    public function setTimeGauge(int $time_gauge): self
    {
        $this->time_gauge = $time_gauge;

        return $this;
    }

    public function getTotalTimeServiceGiven(): ?int
    {
        return $this->total_time_service_given;
    }

    public function setTotalTimeServiceGiven(int $total_time_service_given): self
    {
        $this->total_time_service_given = $total_time_service_given;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategoryAffinity(): Collection
    {
        return $this->category_affinity;
    }

    public function addCategoryAffinity(Category $categoryAffinity): self
    {
        if (!$this->category_affinity->contains($categoryAffinity)) {
            $this->category_affinity[] = $categoryAffinity;
        }

        return $this;
    }

    public function removeCategoryAffinity(Category $categoryAffinity): self
    {
        if ($this->category_affinity->contains($categoryAffinity)) {
            $this->category_affinity->removeElement($categoryAffinity);
        }

        return $this;
    }

    /**
     * @return Collection|SubCategory[]
     */
    public function getSubCatAffinity(): Collection
    {
        return $this->sub_cat_affinity;
    }

    public function addSubCatAffinity(SubCategory $subCatAffinity): self
    {
        if (!$this->sub_cat_affinity->contains($subCatAffinity)) {
            $this->sub_cat_affinity[] = $subCatAffinity;
        }

        return $this;
    }

    public function removeSubCatAffinity(SubCategory $subCatAffinity): self
    {
        if ($this->sub_cat_affinity->contains($subCatAffinity)) {
            $this->sub_cat_affinity->removeElement($subCatAffinity);
        }

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setUser($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            // set the owning side to null (unless already changed)
            if ($contact->getUser() === $this) {
                $contact->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setUserFrom($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getUserFrom() === $this) {
                $comment->setUserFrom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Mailbox[]
     */
    public function getMailboxes(): Collection
    {
        return $this->mailboxes;
    }

    public function addMailbox(Mailbox $mailbox): self
    {
        if (!$this->mailboxes->contains($mailbox)) {
            $this->mailboxes[] = $mailbox;
            $mailbox->setUserFrom($this);
        }

        return $this;
    }

    public function removeMailbox(Mailbox $mailbox): self
    {
        if ($this->mailboxes->contains($mailbox)) {
            $this->mailboxes->removeElement($mailbox);
            // set the owning side to null (unless already changed)
            if ($mailbox->getUserFrom() === $this) {
                $mailbox->setUserFrom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Service[]
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->setUser($this);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->contains($service)) {
            $this->services->removeElement($service);
            // set the owning side to null (unless already changed)
            if ($service->getUser() === $this) {
                $service->setUser(null);
            }
        }

        return $this;
    }


    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }



}
