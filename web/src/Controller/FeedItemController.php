<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedItemController extends AbstractController
{
    #[Route('/api/v1/feed/item', name: 'app_feed_item')]
    public function index(): Response
    {
        return $this->render('feed_item/index.html.twig', [
            'controller_name' => 'FeedItemController',
        ]);
    }
}
