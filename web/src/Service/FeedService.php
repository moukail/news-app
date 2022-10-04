<?php

namespace App\Service;

use App\Entity\Feed;
use App\Repository\FeedRepository;
use App\Repository\FeedItemRepository;
use Elastic\Elasticsearch\Client;

class FeedService
{
    public function __construct
    (
        private FeedItemRepository $feedItemRepository,
        private Client $elasticsearchClient
    ) {}

    public function parseRss(Feed $feed): void
    {
        $xml = simplexml_load_file($feed->getLink());

        foreach ($xml->channel->item as $item) {

            $this->feedItemRepository->save($feed, [
                'id' => $item->guid,
                'title' => $item->title,
                'description' => (string) $item->description,
                'article' => $item->link,
                'link' => $item->link,
            ]);

            $params = [
                'index' => $_ENV['ELASTIC_SEARCH_INDEX'],
                'id' => md5($item->guid),
                'body'  => [
                    'title' => (string) $item->title,
                    'description' => (string) $item->description,
                ]
            ];

            $this->elasticsearchClient->index($params);

            //echo $item->description . PHP_EOL;

            //if ($item->enclosure) {
                //echo $item->enclosure->attributes()->type . PHP_EOL;
                //echo $item->enclosure->attributes()->url . PHP_EOL;
            //}

            //$content = $xml->channel->item->children('media', true)->content;
            //if ($content) {
             //   echo $content->attributes()->type . PHP_EOL;
            //    echo $content->attributes()->url . PHP_EOL;
            //}

            //$categories = $item->category;
            //print_r($categories[0]);
        }

    }

}