<?php

namespace Tests\Unit\XoopsModules\About;

use PHPUnit\Framework\TestCase;
use XoopsModules\About\Utility;

/**
 * Class UtilityTest.
 *
 * @covers \XoopsModules\About\Utility
 */
final class UtilityTest extends TestCase
{
    private Utility $utility;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->utility = new Utility();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->utility);
    }

    public function testAboutmkdirs(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetTemplate(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetTemplateList(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetCss(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetModuleHeader(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetTplPageList(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testTemplate_lookup(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
