<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Board;
use App\Form\BoardType;
use App\Repository\BoardRepository;
use App\Repository\ThreadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @param BoardRepository $boardRepository
     * @return Response
     */
    #[Route(path: '/new', name: 'board_new')]
    public function new(
        Request $request,
        BoardRepository $boardRepository,
    ): Response {
        $board = new Board();
        $form = $this->createForm(BoardType::class, $board);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $boardRepository->createOrUpdate($board);
            return $this->redirectToRoute(
                'board_show',
                [
                    'board' => $board->getId()
                ]
            );
        }
        return $this->render(
            'board/new.html.twig',
            [
                'form' => $form->createView()
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
