<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubmissionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubmissionTable Test Case
 */
class SubmissionTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SubmissionTable
     */
    public $Submission;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.submission'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Submission') ? [] : ['className' => SubmissionTable::class];
        $this->Submission = TableRegistry::get('Submission', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Submission);

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
