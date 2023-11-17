<?php

namespace App\Controller;

use App\Entity\Reply;
use App\Entity\Thread;
use App\Entity\User;
use App\Form\ReplyType;
use App\Repository\ReplyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

#[Route(path: '/reply')]
class ReplyController extends AbstractController
{
    /**
     * @param Request $request
     * @param Thread $thread
     * @param ReplyRepository $replyRepository
     * @return Response|RedirectResponse
     */
    #[Route(path: '/new/{thread}', name: 'reply_new')]
    public function new(
        Request $request,
        Thread $thread,
        ReplyRepository $replyRepository
    ): Response|RedirectResponse {
        $reply = new Reply();
        $form = $this->createForm(
            ReplyType::class,
            $reply,
            [
                'action' => $this->generateUrl(
                    'reply_new',
                    ['thread' => $thread->getId()]
                )
            ]
        );
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $thread->addReply($reply);
            $reply->setUser($this->getUser());
            $reply->setIpAddress($request->getClientIp());
            $replyRepository->createOrUpdate($reply);
            return $this->redirectToRoute('thread_show', ['thread' => $thread->getId()]);
        }
        return $this->render(
            'reply/new.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}
