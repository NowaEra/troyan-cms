<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AdminAction extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render(
            'admin/base.html.twig',
            []
        );
    }
}
