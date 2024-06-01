<?php

namespace Tests\Unit\XoopsModules\About;

use Mockery;
use Mockery\Mock;
use PHPUnit\Framework\TestCase;
use XoopsDatabase;
use XoopsModules\About\PageHandler;

/**
 * Class PageHandlerTest.
 *
 * @covers \XoopsModules\About\PageHandler
 */
final class PageHandlerTest extends TestCase
{
    private PageHandler $pageHandler;

    private XoopsDatabase|Mock $db;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->db = Mockery::mock(XoopsDatabase::class);
        $this->pageHandler = new PageHandler($this->db);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->pageHandler);
        unset($this->db);
    }

    public function testGetTrees(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testMenuTree(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetBread(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
