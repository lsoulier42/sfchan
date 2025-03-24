<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Board;
use App\Form\BoardType;
use App\Repository\BoardRepository;
use App\Repository\ThreadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

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
    #[IsGranted('ROLE_ADMIN')]
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
     * @param Request $request
     * @param BoardRepository $boardRepository
     * @param Board $board
     * @return Response
     */
    #[Route(path: '/{board}/edit', name: 'board_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(
        Request $request,
        BoardRepository $boardRepository,
        Board $board
    ): Response {
        $form = $this->createForm(BoardType::class, $board);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $boardRepository->createOrUpdate($board);
            return $this->redirectToRoute(
                'board_index'
            );
        }
        return $this->render(
            'board/edit.html.twig',
            [
                'form' => $form->createView(),
                'board' => $board
            ]
        );
    }

    /**
     * @param Board $board
     * @return Response
     */
    #[Route(path: '/{board}/show', name: 'board_show')]
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

    #[Route(path: '/{board}/delete', name: 'board_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(
        Board $board,
        BoardRepository $boardRepository,
    ): RedirectResponse {
        $boardRepository->remove($board);
        $this->addFlash('success', 'Forum supprimé');
        return $this->redirectToRoute(
            'board_index'
        );
    }
}
