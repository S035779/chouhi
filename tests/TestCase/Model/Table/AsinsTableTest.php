<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AsinsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AsinsTable Test Case
 */
class AsinsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AsinsTable
     */
    public $Asins;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.asins'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Asins') ? [] : ['className' => AsinsTable::class];
        $this->Asins = TableRegistry::get('Asins', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Asins);

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
