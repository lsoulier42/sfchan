<?php

namespace App\Controller;

use App\Entity\Board;
use App\Entity\Thread;
use App\Entity\User;
use App\Form\ThreadType;
use App\Repository\ThreadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

#[Route(path: '/thread')]
class ThreadController extends AbstractController
{
    #[Route(path: '/{thread}', name: 'thread_show')]
    public function show(
        Thread $thread
    ): Response {
        $replies = $thread->getReplies();
        return $this->render(
            'thread/show.html.twig',
            [
                'replies' => $replies,
                'thread' => $thread
            ]
        );
    }

    /**
     * @param Request $request
     * @param Board $board
     * @param ThreadRepository $threadRepository
     * @return Response|RedirectResponse
     */
    #[Route(path: '/new/{board}', name: 'thread_new')]
    public function new(
        Request $request,
        Board $board,
        ThreadRepository $threadRepository
    ): Response|RedirectResponse {
        $thread = new Thread();
        $form = $this->createForm(ThreadType::class, $thread);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $board->addThread($thread);
            $thread->setUser($this->getUser());
            $thread->setIpAddress($request->getClientIp());
            $threadRepository->createOrUpdate($thread);
            return $this->redirectToRoute(
                'thread_show',
                [
                    'thread' => $thread->getId()
                ]
            );
        }
        return $this->render(
            'thread/new.html.twig',
            [
                'board' => $board,
                'form' => $form->createView()
            ]
        );
    }
}
