<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomeController extends AbstractController
{
    #[Template('home/index.html.twig')]
    #[Route('/{reactRouting}', name: 'app_feed_list', requirements: ["reactRouting" => "^(?!api).+"], defaults: ["reactRouting" => null], methods: "GET")]
    public function home(): array
    {
        return [];
    }
}
