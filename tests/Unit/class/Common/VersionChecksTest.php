<?php

namespace Tests\Unit\XoopsModules\About\Common;

use PHPUnit\Framework\TestCase;
use XoopsModules\About\Common\VersionChecks;

/**
 * Class VersionChecksTest.
 *
 * @covers \XoopsModules\About\Common\VersionChecks
 */
final class VersionChecksTest extends TestCase
{
    private VersionChecks $versionChecks;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->versionChecks = $this->getMockBuilder(VersionChecks::class)
            ->setConstructorArgs([])
            ->getMockForTrait();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->versionChecks);
    }

    public function testCheckVerXoops(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testCheckVerPhp(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testCheckVerModule(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
