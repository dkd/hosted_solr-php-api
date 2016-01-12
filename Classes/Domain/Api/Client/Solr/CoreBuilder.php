<?php
namespace HostedSolr\ApiClient\Domain\Api\Client\Solr;

class CoreBuilder
{

    /**
     * @var string
     */
    protected static $coreClassName = \HostedSolr\ApiClient\Domain\Api\Client\Solr\Core::class;

    /**
     * @param $name
     * @param string $system
     * @param string $schema
     * @param string $solrVersion
     * @param null $id
     * @param string $createdAt
     * @param string $updatedAt
     * @return \HostedSolr\ApiClient\Domain\Api\Core
     */
    public static function buildFromScalarValues($name, $system = 'typo3', $schema = 'english', $solrVersion = '4.8', $id = null, $createdAt = '', $updatedAt = '')
    {
        $createdAt  = new \DateTime($createdAt, new \DateTimeZone("UTC"));
        $updatedAt  = new \DateTime($updatedAt, new \DateTimeZone("UTC"));
        $core       = new self::$coreClassName($name, $system, $schema, $solrVersion, $id, $createdAt, $updatedAt);

        return $core;
    }
}
