<?php

namespace Tests\Unit\XoopsModules\About;

use PHPUnit\Framework\TestCase;
use XoopsModules\About\BlockForm;

/**
 * Class BlockFormTest.
 *
 * @covers \XoopsModules\About\BlockForm
 */
final class BlockFormTest extends TestCase
{
    private BlockForm $blockForm;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->blockForm = new BlockForm();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->blockForm);
    }

    public function testRender(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
