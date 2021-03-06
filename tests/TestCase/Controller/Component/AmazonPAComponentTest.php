<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\AmazonPAComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\AmazonPAComponent Test Case
 */
class AmazonPAComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\AmazonPAComponent
     */
    public $AmazonPA;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->AmazonPA = new AmazonPAComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AmazonPA);

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
