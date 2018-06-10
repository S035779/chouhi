<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DeliverysTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DeliverysTable Test Case
 */
class DeliverysTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DeliverysTable
     */
    public $Deliverys;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.deliverys'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Deliverys') ? [] : ['className' => DeliverysTable::class];
        $this->Deliverys = TableRegistry::get('Deliverys', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Deliverys);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
