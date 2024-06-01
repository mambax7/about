<?php

namespace Tests\Unit;

use AboutCorePreload;
use PHPUnit\Framework\TestCase;

/**
 * Class AboutCorePreloadTest.
 *
 * @covers \AboutCorePreload
 */
final class AboutCorePreloadTest extends TestCase
{
    private AboutCorePreload $aboutCorePreload;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        /** @todo Correctly instantiate tested object to use it. */
        $this->aboutCorePreload = new AboutCorePreload();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->aboutCorePreload);
    }

    public function testEventCoreIncludeCommonEnd(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
