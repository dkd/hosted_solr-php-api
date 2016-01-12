<?php

namespace HostedSolr\ApiClient\Domain\Api;

/**
 * Class Configuration
 *
 * Holds all api related configuration options that are needed.
 *
 * @author Timo Schmidt <timo.schmidt@dkd.de> *
 * @package HostedSolr\ApiClient\Domain\Api
 */
class Configuration
{
    /**
     * @var string
     */
    protected $endpointBaseUrl = 'https://www.hosted-solr.com/';

    /**
     * @var string
     */
    protected $apiToken = '';

    /**
     * @var string
     */
    protected $secretToken = '';

    /**
     * @param string $endpointBaseUrl
     * @param string $apiToken
     * @param string $secretToken
     */
    public function __construct($endpointBaseUrl, $apiToken, $secretToken)
    {
        $this->endpointBaseUrl = $endpointBaseUrl;
        $this->apiToken = $apiToken;
        $this->secretToken = $secretToken;
    }

    /**
     * @param string $apiToken
     */
    public function setApiToken($apiToken)
    {
        $this->apiToken = $apiToken;
    }

    /**
     * @return string
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * @param string $endpointBaseUrl
     */
    public function setEndpointBaseUrl($endpointBaseUrl)
    {
        $this->endpointBaseUrl = $endpointBaseUrl;
    }

    /**
     * @return string
     */
    public function getEndpointBaseUrl()
    {
        return $this->endpointBaseUrl;
    }

    /**
     * @param string $secretToken
     */
    public function setSecretToken($secretToken)
    {
        $this->secretToken = $secretToken;
    }

    /**
     * @return string
     */
    public function getSecretToken()
    {
        return $this->secretToken;
    }
}
