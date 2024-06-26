<?php declare(strict_types=1);

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

use XoopsModules\About\Constants;
use XoopsModules\About\Helper;
use XoopsModules\About\PageHandler;
use XoopsModules\About\Utility;

/** @var PageHandler $pageHandler */
/** @var Helper $helper */
require_once __DIR__ . '/header.php';

$page_id = Xmf\Request::getInt('page_id', 0);
//$page_id      = isset($_REQUEST['page_id']) ? $_REQUEST['page_id'] : '';
//$pageHandler     = new About\PageHandler($db);

$myts = \MyTextSanitizer::getInstance();

// Menu
$menu_criteria = new \CriteriaCompo();
$menu_criteria->add(new \Criteria('page_status', Constants::PUBLISHED), 'AND');
$menu_criteria->add(new \Criteria('page_menu_status', Constants::IN_MENU), 'AND');
$menu_criteria->setSort('page_order');
$menu_criteria->order = 'ASC';
$fields               = [
    'page_id',
    'page_pid',
    'page_menu_title',
    'page_blank',
    'page_menu_status',
    'page_status',
    'page_text',
];

$menu = $pageHandler->getAll($menu_criteria, $fields, false);
foreach ($menu as $k => $v) {
    $page_text             = $myts->displayTarea(trim((string) $v['page_text']), 1, 1, 1, 1, 1);
    $menu[$k]['page_text'] = false;
    if (preg_match('/^https?\:\/\//', (string) $page_text)) {
        $menu[$k]['page_text'] = true;
    }
    //    $menu[$k]['page_text'] = trim($v['page_text']) === 'https://' ? true : false;
}
$page_menu = $pageHandler->menuTree($menu);

// Display
if (Constants::PAGE === $helper->getConfig('display', Constants::PAGE) || !empty($page_id)) {
    // Fun menu display
    $criteria = new \CriteriaCompo();
    if (!empty($page_id)) {
        $criteria->add(new \Criteria('page_id', $page_id));
    } else {
        $criteria->add(new \Criteria('page_index', Constants::DEFAULT_INDEX));
    }
    $criteria->add(new \Criteria('page_status', Constants::PUBLISHED));

    $criteria->setSort('page_order');
    $criteria->order = 'ASC';
    $page            = current($pageHandler->getObjects($criteria, null, false));
    if (!empty($page)) {
        $xoopsOption['xoops_pagetitle'] = htmlspecialchars($page['page_title'] . ' - ' . $helper->getModule()->name(), ENT_QUOTES | ENT_HTML5);
        $xoopsOption['template_main']   = Utility::getTemplate('page', $page['page_tpl']);
    } else {
        $xoopsOption['xoops_pagetitle'] = htmlspecialchars(_MD_ABOUT_INDEX . ' - ' . $helper->getModule()->name(), ENT_QUOTES | ENT_HTML5);
        $xoopsOption['template_main']   = Utility::getTemplate();
    }

    require_once XOOPS_ROOT_PATH . '/header.php';
    $GLOBALS['xoTheme']->addStylesheet("modules/{$moduleDirName}/assets/css/style.css");
    $GLOBALS['xoTheme']->addStylesheet("modules/{$moduleDirName}/assets/js/jquery-treeview/jquery.treeview.css");
    $GLOBALS['xoTheme']->addScript('browse.php?Frameworks/jquery/jquery.js');
    $GLOBALS['xoTheme']->addScript("modules/{$moduleDirName}/assets/js/jquery-treeview/jquery.treeview.js");

    if (!empty($page)) {
        //        $page['page_text'] = $myts->undoHtmlSpecialChars($page['page_text']);
        $page['page_text'] = $myts->undoHtmlSpecialChars($myts->displayTarea($page['page_text'], 1, 1, 1, 1, 1));
        if (Constants::PAGE_TYPE_LINK == $page['page_type']) {
            header('location: ' . $page['page_text']);
        }
        /** @var xos_opal_Theme $xoTheme */
        $xoTheme->addMeta('meta', 'description', htmlspecialchars((string) $page['page_menu_title'], ENT_QUOTES | ENT_HTML5));
        $xoopsTpl->assign('pagemenu', $page_menu);
        $xoopsTpl->assign('page', $page);
    }
} else {
    // List (Category) display
    $xoopsOption['xoops_pagetitle'] = $helper->getModule()->name();
    $xoopsOption['template_main']   = Utility::getTemplate('list');
    require_once XOOPS_ROOT_PATH . '/header.php';
    $GLOBALS['xoTheme']->addStylesheet("modules/{$moduleDirName}/assets/css/style.css");

    $criteria = new \CriteriaCompo();
    $criteria->add(new \Criteria('page_status', Constants::PUBLISHED));
    $criteria->setSort('page_order');
    $criteria->order = 'ASC';
    $list            = $pageHandler->getAll($criteria, null, false);
    foreach ($list as $k => $v) {
        $text                      = strip_tags((string) $myts->undoHtmlSpecialChars($myts->displayTarea($v['page_text'], 1, 1, 1, 1, 1)));
        $list[$k]['page_text']     = xoops_substr($text, 0, $helper->getConfig('str_ereg', Constants::DEFAULT_EREG));
        $list[$k]['page_pushtime'] = formatTimestamp($v['page_pushtime'], _SHORTDATESTRING);
    }
    $xoopsTpl->assign('list', $list);
}

// get breadcrumb
$tree_open = [];
if (!empty($bread)) {
    $bread = array_reverse($pageHandler->getBread($menu, $page_id), true);
    foreach ($bread as $k => $v) {
        if ($k != $page_id) {
            $xoBreadcrumbs[] = ['title' => $v, 'link' => $helper->url("index.php?page_id={$k}")];
        } else {
            $xoBreadcrumbs[] = ['title' => $v];
        }
        $tree_open[$k] = $k;
    }
    $xoopsTpl->assign('tree_open', $tree_open);
}
$xoopsTpl->assign('page_id', $page_id);

require_once __DIR__ . '/footer.php';
