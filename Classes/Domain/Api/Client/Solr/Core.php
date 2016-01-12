<?php
namespace HostedSolr\ApiClient\Domain\Api\Client\Solr;

class Core
{

    /**
     * @var null
     */
    protected $id;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $internalName;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string (e.g. english)
     */
    protected $schema;

    /**
     * @var string (e.g.
     */
    protected $solrVersion;

    /**
     * @var string (e.g. typo3)
     */
    protected $system;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * @var integer
     */
    protected $userId;

    /**
     * @var boolean
     */
    protected $isActivated;

    /**
     * @param string $name
     * @param string $system
     * @param string $schema
     * @param string $solrVersion
     * @param integer $id
     * @param \DateTime $createdAt
     * @param \DateTime $updatedAt
     */
    public function __construct($name, $system = 'typo3', $schema = 'english', $solrVersion = '4.8', $id = null, \DateTime $createdAt = null, \DateTime $updateDate = null)
    {
        $this->name = $name;
        $this->system = $system;
        $this->schema = $schema;
        $this->solrVersion = $solrVersion;
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getInternalName()
    {
        return $this->internalName;
    }

    /**
     * @return boolean
     */
    public function getIsActivated()
    {
        return $this->isActivated;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * @return string
     */
    public function getSolrVersion()
    {
        return $this->solrVersion;
    }

    /**
     * @return string
     */
    public function getSystem()
    {
        return $this->system;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
