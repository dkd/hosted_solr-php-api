<?php

namespace HostedSolr\ApiClient\System\StorageBackend;

use HostedSolr\ApiClient\Domain\Api\Client\Solr\Core;

/**
 * Interface CoreStorageBackend
 *
 * The CoreStorageBackend interfaces describes the methods that a storage backend need
 * to implement to apply the needed changes to the "Storage" system.
 *
 * @author Timo Schmidt <timo.schmidt@dkd.de>
 * @package HostedSolr\ApiClient\System\StorageBackend
 */
interface CoreStorageBackend {

    /**
     * Performs a get request.
     *
     * @return Core[]
     */
    public function findAll();

    /**
     * The implementation needs to store a core.
     *
     * @param Core $solrCore
     * @return boolean
     */
    public function add(Core $solrCore);

    /**
     * The implementation needs to delete a core.
     *
     * @param Core $solrCore
     * @return boolean
     */
    public function remove(Core $solrCore);

    /**
     * Removes a core by it's id.
     *
     * @param integer $id
     * @return boolean
     */
    public function removeById($id);
}