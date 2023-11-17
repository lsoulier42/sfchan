<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Board;
use App\Repository\BoardRepository;
use App\Repository\ThreadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/board')]
class BoardController extends AbstractController
{
    /**
     * @param BoardRepository $boardRepository
     * @return Response
     */
    #[Route(path: '/', name: 'board_index')]
    public function index(
        BoardRepository $boardRepository
    ): Response {
        $boards = $boardRepository->findAll();
        return $this->render(
            'board/index.html.twig',
            [
                'boards' => $boards
            ]
        );
    }

    /**
     * @param Board $board
     * @return Response
     */
    #[Route(path: '/{board}', name: 'board_show')]
    public function show(
        Board $board
    ): Response {
        $threads = $board->getThreads();
        return $this->render(
            'board/show.html.twig',
            [
                'threads' => $threads,
                'board' => $board
            ]
        );
    }
}
