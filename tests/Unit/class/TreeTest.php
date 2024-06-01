<?php

namespace Tests\Unit\XoopsModules\About;

use PHPUnit\Framework\TestCase;
use XoopsModules\About\Tree;

/**
 * Class TreeTest.
 *
 * @covers \XoopsModules\About\Tree
 */
final class TreeTest extends TestCase
{
    private Tree $tree;

    private array $objectArr;

    private mixed $rootId;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->objectArr = [];
        $this->rootId = null;
        $this->tree = new Tree($this->objectArr, $this->rootId);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->tree);
        unset($this->objectArr);
        unset($this->rootId);
    }

    public function testMakeTreeItems(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testMakeTree(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testMakeSelBox(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testGetAllChildArray(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }

    public function testMakeArrayTree(): void
    {
        /** @todo This test is incomplete. */
        $this->markTestIncomplete();
    }
}
