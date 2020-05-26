<?php

namespace App\Entity;

use App\Repository\MailboxRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MailboxRepository::class)
 */
class Mailbox
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="mailboxes")
     */
    private $user_from;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="mailboxes")
     */
    private $user_for;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message_title;

    /**
     * @ORM\Column(type="text")
     */
    private $message_body;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return (string)$this->getId();
    }

    public function getUserFrom(): ?User
    {
        return $this->user_from;
    }

    public function setUserFrom(?User $user_from): self
    {
        $this->user_from = $user_from;

        return $this;
    }

    public function getUserFor(): ?User
    {
        return $this->user_for;
    }

    public function setUserFor(?User $user_for): self
    {
        $this->user_for = $user_for;

        return $this;
    }

    public function getMessageTitle(): ?string
    {
        return $this->message_title;
    }

    public function setMessageTitle(string $message_title): self
    {
        $this->message_title = $message_title;

        return $this;
    }

    public function getMessageBody(): ?string
    {
        return $this->message_body;
    }

    public function setMessageBody(string $message_body): self
    {
        $this->message_body = $message_body;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}