<?php

namespace App\Service;

use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;

class ElasticsearchClientFactory
{
    public static function create(): Client
    {
        return ClientBuilder::create()
            ->setHosts([$_ENV['ELASTIC_SEARCH_HOST']])
            ->build();
    }
}