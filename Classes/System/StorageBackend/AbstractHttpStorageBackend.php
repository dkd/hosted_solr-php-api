<?php

namespace HostedSolr\ApiClient\System\StorageBackend;

use HostedSolr\ApiClient\Domain\Api\Configuration;

abstract class AbstractHttpStorageBackend {

    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * @var Configuration
     */
    protected $configuration;

    /**
     * @param \GuzzleHttp\Client $httpClient
     * @param Configuration $configuration
     */
    public function __construct(\GuzzleHttp\Client $httpClient, Configuration $configuration) {
        $this->httpClient = $httpClient;
        $this->configuration = $configuration;
    }
}