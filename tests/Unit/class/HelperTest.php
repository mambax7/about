<?php

namespace Tests\Unit\XoopsModules\About;

use PHPUnit\Framework\TestCase;
use XoopsModules\About\Helper;

/**
 * Class HelperTest.
 *
 * @covers \XoopsModules\About\Helper
 */
final class HelperTest extends TestCase
{
    private Helper $helper;

    private bool $debug;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->debug = true;
        $this->helper = new Helper($this->debug);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->helper);
        unset($this->debug);
    }

    public function testGetInstance(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetDirname(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetHandler(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
