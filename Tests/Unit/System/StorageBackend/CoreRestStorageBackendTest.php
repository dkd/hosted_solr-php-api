<?php

namespace HostedSolr\ApiClient\Tests\Unit\System\StorageBackend;

use GuzzleHttp\Psr7\Response;
use HostedSolr\ApiClient\Domain\Api\Client\Solr\Core;
use HostedSolr\ApiClient\Domain\Api\Configuration;
use HostedSolr\ApiClient\System\StorageBackend\CoreRestStorageBackend;
use HostedSolr\ApiClient\Tests\Unit\AbstractUnitTest;
use HostedSolr\ApiClient\Exception\HostedSolrApiException;

class CoreRestStorageBackendTest extends AbstractUnitTest
{

    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClientMock;

    /**
     * @var CoreRestStorageBackend
     */
    protected $coreRestStorageBackend;

    /**
     * @var Configuration
     */
    protected $configuration;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->configuration = new Configuration('https://myendpoint.com', 'foo', 'bar');
        $this->httpClientMock = $this->getMock(\GuzzleHttp\Client::class, array('get', 'post', 'delete'), array(), '', false);
        $this->coreRestStorageBackend = new CoreRestStorageBackend($this->httpClientMock, $this->configuration);
    }

    /**
     * @test
     */
    public function canRetrieveCoreCollectionFromApiResponse()
    {
        $fakeResponse = $this->getFixtureContent('getResponseWithMultipleCores.json');
        $expectedGetEndpoint = 'https://myendpoint.com/api/solr_cores.json?api_token=foo&secret_token=bar';

        $responseMock = $this->getMock(Response::class, array('getBody', 'getStatusCode'), array(), '', false);
        $responseMock->expects($this->once())->method('getBody')->will($this->returnValue($fakeResponse));
        $responseMock->expects($this->any())->method('getStatusCode')->will($this->returnValue(200));
        $this->httpClientMock->expects($this->any())->method('get')->with($expectedGetEndpoint)->will($this->returnValue($responseMock));

        $cores = $this->coreRestStorageBackend->findAll();
        $this->assertSame(2, count($cores), 'Unexpected amount of cores');
    }

    /**
     * @test
     */
    public function canThrowExceptionWhenGetRequestWasNotSuccessful()
    {
        $this->setExpectedException(HostedSolrApiException::class);
        $responseMock = $this->getMock(Response::class, array('getBody', 'getStatusCode'), array(), '', false);
        $responseMock->expects($this->any())->method('getStatusCode')->will($this->returnValue(503));
        $this->httpClientMock->expects($this->any())->method('get')->will($this->returnValue($responseMock));
        $cores = $this->coreRestStorageBackend->findAll();
    }

    /**
     * @test
     */
    public function canAddAValidCore()
    {
        $core = new Core('testcore', 'typo3', 'english', '4.8');
        $responseMock = $this->getMock(Response::class, array('getBody', 'getStatusCode'), array(), '', false);
        $responseMock->expects($this->any())->method('getStatusCode')->will($this->returnValue(201));
        $expectedPostEndpoint = 'https://myendpoint.com/api/solr_cores.json?solr_core[name]=testcore&solr_core[solr_version]=4.8&solr_core[system]=typo3&solr_core[schema]=english&api_token=foo&secret_token=bar';
        $this->httpClientMock->expects($this->once())->method('post')->with($expectedPostEndpoint)->will($this->returnValue($responseMock));

        $result = $this->coreRestStorageBackend->add($core);
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function canRemoveAValidCore()
    {
        $core = new Core('testcore', 'typo3', 'english', '4.8', 1);
        $responseMock = $this->getMock(Response::class, array('getBody', 'getStatusCode'), array(), '', false);
        $responseMock->expects($this->any())->method('getStatusCode')->will($this->returnValue(204));
        $expectedDeleteEndpoint = 'https://myendpoint.com/api/solr_cores/1.json?api_token=foo&secret_token=bar';
        $this->httpClientMock->expects($this->once())->method('post')->with($expectedDeleteEndpoint)->will($this->returnValue($responseMock));

        $result = $this->coreRestStorageBackend->remove($core);
        $this->assertTrue($result);
    }
}
