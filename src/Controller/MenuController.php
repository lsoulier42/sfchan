<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends AbstractController
{
    /**
     * @return Response
     */
    public function renderMenu(): Response
    {
        return $this->render('shared/layout/_menu.html.twig');
    }
}
