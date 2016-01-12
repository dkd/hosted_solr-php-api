<?php

namespace HostedSolr\ApiClient\System\StorageBackend;

use HostedSolr\ApiClient\Exception\HostedSolrApiException;
use HostedSolr\ApiClient\Domain\Api\Client\Solr\Core;

class CoreRestStorageBackend extends AbstractHttpStorageBackend
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
        $coresFromApi = json_decode($jsonResponse);

        foreach ($coresFromApi as $coreFromApi) {
            $core = new Core($coreFromApi->name,
                                $coresFromApi->system,
                                $coresFromApi->schema,
                                $coresFromApi->solr_version,
                                $coresFromApi->id);
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
        $response = $this->httpClient->post($url);

        $this->throwApiExceptionWhenStatusIsUnexpected(array(204), $response, 'Unexpected API Status during delete request!');

        return true;
    }
}
