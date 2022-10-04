<?php

namespace App\Controller;

use App\Repository\FeedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FeedController extends AbstractController
{
    #[Route('/api/v1/feed', name: 'app_feed_list', methods: "GET")]
    public function list(FeedRepository $feedRepository): JsonResponse
    {
        $list = $feedRepository->findAll();

        return $this->json($list, JsonResponse::HTTP_OK, [], [
            'groups' => ['manager'],
        ]);
    }
}
