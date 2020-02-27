<?php

namespace App\Controller\Admin\View;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DashboardAction extends AbstractController
{
    public function __invoke(): Response
    {
        return $this->render(
            'admin/view/dashboard.html.twig',
            []
        );
    }
}
