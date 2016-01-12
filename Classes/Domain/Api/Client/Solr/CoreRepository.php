<?php
namespace HostedSolr\ApiClient\Domain\Api\Client\Solr;

use HostedSolr\ApiClient\System\StorageBackend\CoreStorageBackend;

/**
 * Class CoreRepository
 *
 * Can be used to add, remove or retrieve all cores.
 *
 * @author Timo Schmidt <timo.schmidt@dkd.de>
 * @package HostedSolr\ApiClient\Domain\Api\Client\Solr
 */
class CoreRepository
{
    /**
     * @var CoreStorageBackend
     */
    protected $storageBackend;

    public function __construct(CoreStorageBackend $storageBackend) {
        $this->storageBackend = $storageBackend;
    }

    /**
     * @param Core $core
     */
    public function add(Core $core)
    {
        return $this->storageBackend->add($core);
    }

    /**
     * @param Core $core
     */
    public function has(Core $core)
    {
        $allApiCores = $this->storageBackend->findAll();
        foreach($allApiCores as $apiCore) {
            if($core->getName() == $apiCore->getName()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param Core $core
     */
    public function remove(Core $core)
    {
        return $this->storageBackend->remove($core);
    }

    /**
     * Core[]
     */
    public function findAll()
    {
        return $this->storageBackend->findAll();
    }
}
