<?php

namespace Tests\Unit\XoopsModules\About\Common;

use PHPUnit\Framework\TestCase;
use XoopsModules\About\Common\SysUtility;

/**
 * Class SysUtilityTest.
 *
 * @covers \XoopsModules\About\Common\SysUtility
 */
final class SysUtilityTest extends TestCase
{
    private SysUtility $sysUtility;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->sysUtility = new SysUtility();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->sysUtility);
    }

    public function testGetInstance(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testCloneRecord(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTruncateHtml(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetEditor(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testFieldExists(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testPrepareFolder(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTableExists(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testAddField(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testQueryAndCheck(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testQueryFAndCheck(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
