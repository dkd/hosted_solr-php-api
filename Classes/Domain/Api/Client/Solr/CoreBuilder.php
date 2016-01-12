<?php
namespace HostedSolr\ApiClient\Domain\Api\Client\Solr;
use HostedSolr\ApiClient\Domain\Api\Client\Solr\Core;

/**
 * Class CoreBuilder
 *
 * Can be used to create an instance of the core object.
 *
 * @author Timo Schmidt <timo.schmidt@dkd.de>
 * @package HostedSolr\ApiClient\Domain\Api\Client\Solr
 */
class CoreBuilder
{

    /**
     * @var string
     */
    protected static $coreClassName = Core::class;

    /**
     * @param $name
     * @param string $system
     * @param string $schema
     * @param string $solrVersion
     * @param null $id
     * @param string $createdAt
     * @param string $updatedAt
     * @param null $userId
     * @param bool $isActivated
     * @param null $internalName
     * @param null $password
     * @return Core
     */
    public static function buildFromScalarValues($name, $system = 'typo3', $schema = 'english', $solrVersion = '4.8', $id = null, $createdAt = '', $updatedAt = '', $userId = null, $isActivated = false, $internalName = null, $password = null)
    {
        $createdAt  = new \DateTime($createdAt, new \DateTimeZone("UTC"));
        $updatedAt  = new \DateTime($updatedAt, new \DateTimeZone("UTC"));
        $core       = new self::$coreClassName($name, $system, $schema, $solrVersion, $id, $createdAt, $updatedAt, $userId, $isActivated, $internalName, $password);

        return $core;
    }
}
