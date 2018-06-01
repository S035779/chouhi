<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\AmazonMWSComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\AmazonMWSComponent Test Case
 */
class AmazonMWSComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\AmazonMWSComponent
     */
    public $AmazonMWS;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->AmazonMWS = new AmazonMWSComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AmazonMWS);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
