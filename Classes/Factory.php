<?php

namespace HostedSolr\ApiClient;

use GuzzleHttp\Client;
use HostedSolr\ApiClient\Domain\Api\Client\Solr\CoreRepository;
use HostedSolr\ApiClient\Domain\Api\Configuration;
use HostedSolr\ApiClient\Domain\Api\Service;
use HostedSolr\ApiClient\System\StorageBackend\CoreRestStorageBackend;

/**
 * Class Factory
 *
 * Since we do not use dependency injection for this simple package, the factory is responsible
 * to create the objects that are usable from outside and build all dependencies.
 *
 * @author Timo Schmidt <timo.schmidt@dkd.de>
 * @package HostedSolr\ApiClient
 */
class Factory {

    /**
     * @param $apiToken
     * @param $secretToken
     * @param string $endPointBaseUrl
     * @param array $guzzleConfig
     * @return Service
     */
    public static function getApiService($apiToken, $secretToken, $endPointBaseUrl = 'https://www.hosted-solr.com', $guzzleConfig = array()) {

        $guzzleHttpClient   = new Client($guzzleConfig);
        $configuration      = new Configuration($endPointBaseUrl, $apiToken, $secretToken);
        $restBackend        = new CoreRestStorageBackend($guzzleHttpClient, $configuration);
        $repository         = new CoreRepository($restBackend);
        $service            = new Service($repository);

        return $service;
    }
}