<?php

namespace HostedSolr\ApiClient\Exception;

use GuzzleHttp\Psr7\Response;

class HostedSolrApiException extends \Exception {

    /**
     * @var Response
     */
    protected $response;

    /**
     * @param \GuzzleHttp\Psr7\Response $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }

    /**
     * @return \GuzzleHttp\Psr7\Response
     */
    public function getResponse()
    {
        return $this->response;
    }

}