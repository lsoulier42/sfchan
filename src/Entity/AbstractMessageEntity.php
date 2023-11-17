<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Validator\Constraints\NotBlank;

abstract class AbstractMessageEntity extends AbstractEntity
{
    /**
     * @var string $content
     */
    #[Column(type: Types::TEXT)]
    #[NotBlank]
    protected string $content;

    /**
     * @var User|null $user
     */
    #[ManyToOne(targetEntity: User::class)]
    #[JoinColumn(nullable: true)]
    protected ?User $user = null;

    /**
     * @var string|null $ipAddress
     */
    #[Column(nullable: true)]
    protected ?string $ipAddress = null;

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return self
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        $user = $this->getUser();
        return $user !== null ? $user->getUsername() : 'Anonymous';
    }

    /**
     * @return string|null
     */
    public function getIpAddress(): ?string
    {
        return $this->ipAddress;
    }

    /**
     * @param string|null $ipAddress
     * @return self
     */
    public function setIpAddress(?string $ipAddress): self
    {
        $this->ipAddress = $ipAddress;
        return $this;
    }
}
