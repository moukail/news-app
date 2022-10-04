<?php

namespace App\Controller;

use App\Service\ElasticsearchClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Elastic\Elasticsearch\Client;

class SearchController extends AbstractController
{
    #[Route('/api/v1/search/{term}', name: 'app_search', methods: "GET")]
    public function index(Request $request, string $term, Client $elasticSearchClient): JsonResponse
    {
        $params = [
            'body'  => [
                'query' => [
                    'bool' => [
                        'should' => [
                            'match' => ['title' => $term],
                            'match' => ['description' => $term]
                        ]
                    ]
                ]
            ]
        ];

        $response = $elasticSearchClient->search($params);

        //$totalDocs = $response['hits']['total']['value'];

        return $this->json($response['hits']['hits'], JsonResponse::HTTP_OK);
    }
}
