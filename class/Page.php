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

/**
 * Class Page
 */
class Page extends \XoopsObject
{
    private int $page_id;
    private int $page_pid;
    private string $page_title;
    private string $page_menu_title;
    private string $page_image;
    private string $page_text;
    private string $page_author;
    private int $page_pushtime;
    private int $page_blank;
    private int $page_menu_status;
    private int $page_type;
    private int $page_status;
    private int $page_order;
    //private string $page_url ;
    private int $page_index;
    private string $page_tpl;
    private int $dohtml;
    private int $dosmiley;
    private int $doxcode;
    private int $doimage;
    private int $dobr;

    /**
     * Page constructor.
     */
    public function __construct()
    {
        $this->initVar('page_id', \XOBJ_DTYPE_INT, null, false);
        $this->initVar('page_pid', \XOBJ_DTYPE_INT, 0);
        $this->initVar('page_title', \XOBJ_DTYPE_TXTBOX, '');
        $this->initVar('page_menu_title', \XOBJ_DTYPE_TXTBOX, '');
        $this->initVar('page_image', \XOBJ_DTYPE_TXTBOX, '');
        $this->initVar('page_text', \XOBJ_DTYPE_OTHER, '');
        $this->initVar('page_author', \XOBJ_DTYPE_TXTBOX, '');
        $this->initVar('page_pushtime', \XOBJ_DTYPE_INT);
        $this->initVar('page_blank', \XOBJ_DTYPE_INT, 0);
        $this->initVar('page_menu_status', \XOBJ_DTYPE_INT, 0);
        $this->initVar('page_type', \XOBJ_DTYPE_INT, 0);
        $this->initVar('page_status', \XOBJ_DTYPE_INT, 0);
        $this->initVar('page_order', \XOBJ_DTYPE_INT, 0);
        //$this->initVar('page_url', XOBJ_DTYPE_TXTBOX,"");
        $this->initVar('page_index', \XOBJ_DTYPE_INT, 0);
        $this->initVar('page_tpl', \XOBJ_DTYPE_TXTBOX, '');
        $this->initVar('dohtml', \XOBJ_DTYPE_INT, 1);
        $this->initVar('dosmiley', \XOBJ_DTYPE_INT, 0);
        $this->initVar('doxcode', \XOBJ_DTYPE_INT, 0);
        $this->initVar('doimage', \XOBJ_DTYPE_INT, 0);
        $this->initVar('dobr', \XOBJ_DTYPE_INT, 0);
    }
}
