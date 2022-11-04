<?php

namespace App\Controller;

use App\Repository\FeedItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FeedItemController extends AbstractController
{
    #[Route('/api/v1/feed/item', name: 'app_feed_item_list', methods: "GET")]
    public function list(FeedItemRepository $feedItemRepository): JsonResponse
    {
        $list = $feedItemRepository->findAll();

        return $this->json($list, JsonResponse::HTTP_OK, [], [
            'groups' => ['user'],
        ]);
    }
}
