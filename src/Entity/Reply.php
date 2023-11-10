<?php

namespace App\Entity;

use App\Repository\ReplyRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity(repositoryClass: ReplyRepository::class)]
class Reply extends AbstractMessageEntity
{
    #[ManyToOne(targetEntity: Thread::class, inversedBy: 'replies')]
    #[JoinColumn(nullable: false)]
    private Thread $thread;

    /**
     * Get the value of thread
     *
     * @return Thread
     */
    public function getThread(): Thread
    {
        return $this->thread;
    }

    /**
     * Set the value of thread
     *
     * @param Thread $thread
     *
     * @return self
     */
    public function setThread(Thread $thread): self
    {
        $this->thread = $thread;

        return $this;
    }
}
