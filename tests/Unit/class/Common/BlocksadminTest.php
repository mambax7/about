<?php

namespace Tests\Unit\XoopsModules\About\Common;

use Mockery;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;
use XoopsDatabase;
use XoopsModules\About\Common\Blocksadmin;
use XoopsModules\About\Helper;

/**
 * Class BlocksadminTest.
 *
 * @covers \XoopsModules\About\Common\Blocksadmin
 */
final class BlocksadminTest extends TestCase
{
    private Blocksadmin $blocksadmin;

    private XoopsDatabase|Mock $db;

    private Helper|Mock $helper;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->db = Mockery::mock(XoopsDatabase::class);
        $this->helper = Mockery::mock(Helper::class);
        $this->blocksadmin = new Blocksadmin($this->db, $this->helper);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->blocksadmin);
        unset($this->db);
        unset($this->helper);
    }

    public function testListBlocks(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testDeleteBlock(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testCloneBlock(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testIsBlockCloned(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testSetOrder(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testEditBlock(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testUpdateBlock(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testOrderBlock(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testRender(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
