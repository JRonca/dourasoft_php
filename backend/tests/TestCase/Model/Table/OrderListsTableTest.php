<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrderListsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrderListsTable Test Case
 */
class OrderListsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\OrderListsTable
     */
    public $OrderLists;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.OrderLists',
        'app.Orders',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('OrderLists') ? [] : ['className' => OrderListsTable::class];
        $this->OrderLists = TableRegistry::getTableLocator()->get('OrderLists', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrderLists);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
