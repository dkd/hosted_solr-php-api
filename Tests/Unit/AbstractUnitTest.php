<?php

namespace HostedSolr\ApiClient\Tests\Unit;

/**
 * Class AbstractUnitTest
 * @package HostedSolr\ApiClient\Tests
 */
abstract class AbstractUnitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Returns the absolute root path to the fixtures.
     *
     * @return string
     */
    protected function getFixtureRootPath()
    {
        return $this->getRuntimeDirectory() . '/Fixtures/';
    }
    /**
     * Returns the absolute path to a fixture file.
     *
     * @param $fixtureName
     * @return string
     */
    protected function getFixturePath($fixtureName)
    {
        return $this->getFixtureRootPath() . $fixtureName;
    }
    /**
     * Returns the content of a fixture file.
     *
     * @param string $fixtureName
     * @return string
     */
    protected function getFixtureContent($fixtureName)
    {
        return file_get_contents($this->getFixturePath($fixtureName));
    }

    /**
     * Returns the directory on runtime.
     *
     * @return string
     */
    protected function getRuntimeDirectory()
    {
        $rc = new \ReflectionClass(get_class($this));
        return dirname($rc->getFileName());
    }
}
