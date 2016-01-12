<?php

namespace HostedSolr\ApiClient\System\StorageBackend;

use HostedSolr\ApiClient\Domain\Api\Client\Solr\CoreBuilder;
use HostedSolr\ApiClient\Exception\HostedSolrApiException;
use HostedSolr\ApiClient\Domain\Api\Client\Solr\Core;
use Psr\Http\Message\ResponseInterface;

/**
 * Class CoreRestStorageBackend
 *
 * @author Timo Schmidt <timo.schmidt@dkd.de>
 * @package HostedSolr\ApiClient\System\StorageBackend
 */
class CoreRestStorageBackend extends AbstractHttpStorageBackend implements CoreStorageBackend
{
    /**
     * @return string
     */
    protected function getEndpointUrl()
    {
        return $this->configuration->getEndpointBaseUrl() .
                '/api/solr_cores';
    }

    /**
     * @param string $url
     * @return string
     */
    protected function addApiSecretAndToken($url)
    {
        return $url . 'api_token=' . $this->configuration->getApiToken() .
        '&secret_token=' . $this->configuration->getSecretToken();
    }

    /**
     * @param array $allowedStatusCodes
     * @param ResponseInterface $response
     * @param string $errorMessage
     * @throws \HostedSolr\ApiClient\Exception\HostedSolrApiException
     */
    protected function throwApiExceptionWhenStatusIsUnexpected(array $allowedStatusCodes, $response, $errorMessage)
    {
        if (!in_array($response->getStatusCode(), $allowedStatusCodes)) {
            $exception = new HostedSolrApiException($errorMessage . ' Statuscode: ' . (int) $response->getStatusCode());
            $exception->setResponse($response);
            throw $exception;
        }
    }

    /**
     * Performs a get request.
     *
     * @return Core[]
     */
    public function findAll()
    {
        $cores = array();

        $url = $this->getEndpointUrl() . '.json?';
        $url = $this->addApiSecretAndToken($url);

        $response = $this->httpClient->get($url);

        $this->throwApiExceptionWhenStatusIsUnexpected(array(200), $response, 'Unexpected API Status during get request ');

        $jsonResponse = $response->getBody();
        $apiCores = json_decode($jsonResponse);

        foreach ($apiCores as $apiCore) {
            $core = CoreBuilder::buildFromScalarValues(
                $apiCore->name,
                $apiCore->system,
                $apiCore->schema,
                $apiCore->solr_version,
                $apiCore->id,
                $apiCore->created_at,
                $apiCore->updated_at,
                $apiCore->user_id,
                $apiCore->is_activated,
                $apiCore->internal_name,
                $apiCore->password
            );
            $cores[] = $core;
        }

        return $cores;
    }

    /**
     * Performs a post request.
     *
     * @param Core $solrCore
     * @throws \HostedSolr\ApiClient\Exception\HostedSolrApiException
     * @return boolean
     */
    public function add(Core $solrCore)
    {
        $url = $this->getEndpointUrl() . '.json?solr_core[name]=' . $solrCore->getName() .
                    '&solr_core[solr_version]='. $solrCore->getSolrVersion() .
                    '&solr_core[system]=' . $solrCore->getSystem() .
                    '&solr_core[schema]=' . $solrCore->getSchema() .
                    '&';
        $url = $this->addApiSecretAndToken($url);
        $response = $this->httpClient->post($url);

        $this->throwApiExceptionWhenStatusIsUnexpected(array(201), $response, 'Unexpected API Status during post request!');

        return true;
    }

    /**
     * Performs a delete Request.
     *
     * @param Core $solrCore
     * @throws \HostedSolr\ApiClient\Exception\HostedSolrApiException
     * @return boolean
     */
    public function remove(Core $solrCore)
    {
        $url = $this->getEndpointUrl() . '/' . $solrCore->getId() . '.json?';
        $url = $this->addApiSecretAndToken($url);
        $response = $this->httpClient->delete($url);

        $this->throwApiExceptionWhenStatusIsUnexpected(array(204), $response, 'Unexpected API Status during delete request!');

        return true;
    }
}
