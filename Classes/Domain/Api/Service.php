<?php

namespace HostedSolr\ApiClient\Domain\Api;

use HostedSolr\ApiClient\Domain\Api\Client\Solr\Core;
use HostedSolr\ApiClient\Domain\Api\Client\Solr\CoreBuilder;
use HostedSolr\ApiClient\Domain\Api\Client\Solr\CoreRepository;

class Service {

    /**
     * @var CoreRepository
     */
    protected $coreRepository;

    /**
     * @param CoreRepository $coreRepository
     */
    public function __construct(CoreRepository $coreRepository)
    {
        $this->coreRepository = $coreRepository;
    }

    /**
     * Retrieves a your registered cores.
     *
     * @return Client\Solr\Core[]
     */
    public function getAllCores()
    {
        return $this->coreRepository->findAll();
    }

    /**
     * Can be used to delete all you cores.
     * Use with attention!
     *
     * @return boolean
     */
    public function deleteAllCores()
    {
        $allResult = true;
        $cores = $this->getAllCores();
        foreach($cores as $core) {
            $result = $this->coreRepository->remove($core);
            $allResult = $allResult && $result;
        }

        return $allResult;
    }

    /**
     * @param Core $core
     * @return bool
     */
    public function deleteCore(Core $core)
    {
        return $this->coreRepository->remove($core);
    }

    /**
     * Deletes core by given identifier
     *
     * @param integer $id
     * @return bool
     */
    public function deleteCoreById($id)
    {
        return $this->coreRepository->removeById($id);
    }

    /**
     * Can be used to create a new core by passing some required scalar values.
     *
     * @param string $name
     * @param string $system
     * @param string $solrVersion
     * @param string $schema
     *
     * @throws \InvalidArgumentException
     * @return boolean
     */
    public function createNewCore($name, $system = 'typo3', $solrVersion = '4.8', $schema = 'english', $variant = 'ext-6.1')
    {
        if(trim($name) === '') {
            throw new \InvalidArgumentException('Can not create a core without passing a name');
        }

        $coreToCreate = CoreBuilder::buildFromScalarValues($name, $system, $schema, $solrVersion, $variant);
        return $this->coreRepository->add($coreToCreate);
    }

    /**
     * @return CoreRepository
     */
    public function getCoreRepository()
    {
        return $this->coreRepository;
    }
}