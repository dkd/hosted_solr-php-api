<?php
namespace HostedSolr\ApiClient\Domain\Api\Client\Solr;

class CoreBuilder
{

    /**
     * @var string
     */
    protected static $coreClassName = 'HostedSolr\\ApiClient\\Classes\\Domain\\Api\\Core';

    /**
     * @param string $name
     * @param string $system
     * @param string $schema
     * @param string $solrVersion
     */
    public static function build($name, $system = 'typo3', $schema = 'english', $solrVersion = '4.8')
    {
    }
}
