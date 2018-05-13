<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\StatusHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\StatusHelper Test Case
 */
class StatusHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\StatusHelper
     */
    public $Status;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Status = new StatusHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Status);

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
