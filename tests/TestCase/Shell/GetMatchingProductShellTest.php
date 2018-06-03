<?php
namespace App\Test\TestCase\Shell;

use App\Shell\GetMatchingProductShell;
use Cake\TestSuite\ConsoleIntegrationTestCase;

/**
 * App\Shell\GetMatchingProductShell Test Case
 */
class GetMatchingProductShellTest extends ConsoleIntegrationTestCase
{

    /**
     * ConsoleIo mock
     *
     * @var \Cake\Console\ConsoleIo|\PHPUnit_Framework_MockObject_MockObject
     */
    public $io;

    /**
     * Test subject
     *
     * @var \App\Shell\GetMatchingProductShell
     */
    public $GetMatchingProduct;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->io = $this->getMockBuilder('Cake\Console\ConsoleIo')->getMock();
        $this->GetMatchingProduct = new GetMatchingProductShell($this->io);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->GetMatchingProduct);

        parent::tearDown();
    }

    /**
     * Test getOptionParser method
     *
     * @return void
     */
    public function testGetOptionParser()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test main method
     *
     * @return void
     */
    public function testMain()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
