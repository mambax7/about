<?php declare(strict_types=1);

namespace XoopsModules\About;

/**
 * About
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright      The XOOPS Co.Ltd. https://www.xoops.com.cn
 * @copyright      XOOPS Project (https://xoops.org)
 * @license        GNU GPL 2.0 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @since          1.0.0
 * @author         Mengjue Shao <magic.shao@gmail.com>
 * @author         Susheng Yang <ezskyyoung@gmail.com>
 */

use XoopsModules\About;

/**
 * Class PageHandler
 */
class PageHandler extends \XoopsPersistableObjectHandler
{
    /**
     * PageHandler constructor.
     * @param null|\XoopsDatabase $db
     */
    public function __construct(\XoopsDatabase $db = null)
    {
        parent::__construct($db, 'about_page', Page::class, 'page_id', 'page_title');
    }

    public function getTrees(int $pid = 0, string $prefix = '--', array $tags = []): array
    {
        if (!\is_array($tags) || 0 === \count($tags)) {
            $tags = [
                'page_id',
                'page_pid',
                'page_title',
                'page_title',
                'page_menu_title',
                'page_status',
                'page_order',
            ];
        }
        $criteria = new \CriteriaCompo();
        $criteria->setSort('page_order');
        $criteria->order = 'ASC';
        $pageTree        = &$this->getAll($criteria, $tags);
        $tree            = new About\Tree($pageTree);
        //        $page_array = $tree->makeTree($prefix, $pid, $tags);
        //        return $page_array;
        return $tree->makeTree($prefix, $pid, $tags);
    }

    /**
     * @return array|bool
     */
    public function menuTree(array $pages = [], int $key = 0, int $level = 1)
    {
        $ret = false;
        if (!\is_array($pages) || 0 === \count($pages)) {
            return $ret;
        }
        $menu = [];

        foreach ($pages as $k => $v) {
            if ($v['page_pid'] === $key) {
                $menu[$k]          = $v;
                $menu[$k]['level'] = $level;
                $child             = $this->menuTree($pages, $k, $level + 1);
                if (!empty($child)) {
                    $menu[$k]['child'] = $child;
                }
            }
        }

        return $menu;
    }

    /**
     * @return array|bool
     */
    public function getBread(array $pages = [], int $key = 0)
    {
        if (!\is_array($pages) || 0 === \count($pages)) {
            return false;
        }
        $bread = [];

        if (isset($pages[$key])) {
            $current = $pages[$key];
            $bread   = [$current['page_id'] => $current['page_menu_title']];
            if ($current['page_pid'] > 0) {
                $pageBread = $this->getBread($pages, $current['page_pid']);
                if (!empty($pageBread)) {
                    foreach ($pageBread as $k => $v) {
                        $bread[$k] = $v;
                    }
                }
            }
        }

        return $bread;
    }
}
