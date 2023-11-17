<?php

namespace App\Repository;

use App\Entity\Board;
use App\Entity\Thread;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Thread|null find($id, $lockMode = null, $lockVersion = null)
 * @method Thread|null findOneBy(array $criteria, array $orderBy = null)
 * @method Thread[]    findAll()
 * @method Thread[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThreadRepository extends AbstractRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(
        ManagerRegistry $registry
    ) {
        parent::__construct($registry, Thread::class);
    }

    /**
     * @param Board $board
     * @return Collection<Thread>
     */
    public function findByBoard(
        Board $board
    ): Collection {
        return $this->findByField(
            'board',
            $board
        );
    }
}
