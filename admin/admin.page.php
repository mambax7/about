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

use Xmf\Request;
use XoopsModules\About\Constants;
use XoopsModules\About\PageHandler;

/** @var PageHandler $pageHandler */
/** @var Helper $helper */
require_once __DIR__ . '/admin_header.php';

xoops_cp_header();

$adminObject = Xmf\Module\Admin::getInstance();
$adminObject->displayNavigation(basename(__FILE__));

$op      = Request::getCmd('op', null);
$op ??= isset($_REQUEST['id']) ? 'edit' : 'list';
$page_id = Request::getInt('id', null);

//$pageHandler = new PageHandler();

switch ($op) {
    default:
    case 'list':
        // Page order
        if (Request::hasVar('page_order', 'POST')) {
            $page_order = Request::getArray('page_order', [], 'POST'); //$_POST['page_order'];
            foreach ($page_order as $page_id => $order) {
                $pageObj = $pageHandler->get($page_id);
                if ($order !== $pageObj->getVar('page_order')) {
                    $pageObj->setVar('page_order', $order);
                    $pageHandler->insert($pageObj);
                }
                unset($pageObj);
            }
        }
        // Set index
        if (Request::hasVar('page_index', 'POST')) {
            $page_index = Request::getInt('page_index', Constants::NOT_INDEX, 'POST');
            $pageObj    = $pageHandler->get($page_index);
            if ($page_index !== $pageObj->getVar('page_index')) {
                $pageObj = $pageHandler->get($page_index);
                if (!$pageObj->getVar('page_title')) {
                    $helper->redirect('admin/admin.page.php', Constants::REDIRECT_DELAY_MEDIUM, _AM_ABOUT_PAGE_ORDER_ERROR);
                }
                $pageHandler->updateAll('page_index', Constants::NOT_INDEX, null);
                unset($criteria);
                $pageObj->setVar('page_index', Constants::DEFAULT_INDEX);
                $pageHandler->insert($pageObj);
            }
            unset($pageObj);
        }
        $fields = [
            'page_id',
            'page_pid',
            'page_menu_title',
            'page_author',
            'page_pushtime',
            'page_blank',
            'page_menu_status',
            'page_type',
            'page_status',
            'page_order',
            'page_index',
            'page_tpl',
        ];

        $criteria = new \CriteriaCompo();
        $criteria->setSort('page_order');
        $criteria->order = 'ASC';
        $pages           = $pageHandler->getTrees(0, '--', $fields);
        /** @var \XoopsMemberHandler $memberHandler */
        $memberHandler = xoops_getHandler('member');

        foreach ($pages as $k => $v) {
            $pages[$k]['page_menu_title'] = $v['prefix'] . $v['page_menu_title'];
            $pages[$k]['page_pushtime']   = formatTimestamp($v['page_pushtime'], _DATESTRING);
            $thisuser                     = $memberHandler->getUser($v['page_author']);
            $pages[$k]['page_author']     = $thisuser->getVar('uname');
            unset($thisuser);
        }


    $url = $helper->url();

// Assign the URL directly to the template variable
    $xoopsTpl->assign('mod_url', $url);



        $xoopsTpl->assign('pages', $pages);
        $xoopsTpl->display('db:about_admin_page.tpl');
        break;
    case 'new':
        $GLOBALS['xoTheme']->addStylesheet("modules/{$moduleDirName}/assets/css/admin_style.css");
        $pageObj = $pageHandler->create();
        $form    = require $helper->path('include/form.page.php');
        $form->display();
        break;
    case 'edit':
        $GLOBALS['xoTheme']->addStylesheet("modules/{$moduleDirName}/assets/css/admin_style.css");
        $pageObj = $pageHandler->get($page_id);
        $form    = require $helper->path('include/form.page.php');
        $form->display();
        break;
    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            $helper->redirect('admin/admin.page.php', Constants::REDIRECT_DELAY_MEDIUM, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $pageObj = $pageHandler->get($page_id); // will get page_obj if $page_id is valid, create one if not

        // Assign value to elements of objects
        foreach (array_keys($pageObj->vars) as $key) {
            if (isset($_POST[$key]) && $_POST[$key] !== $pageObj->getVar($key)) {
                $pageObj->setVar($key, $_POST[$key]);
            }
        }
        // Assign menu title
        if (empty($_POST['page_menu_title'])) {
            $pageObj->setVar('page_menu_title', Request::getString('page_title', ''));
        }
        // Set index
        if (!$pageHandler->getCount()) {
            $pageObj->setVar('page_index', Constants::DEFAULT_INDEX);
        }

        // Set submitter
        global $xoopsUser;
        $pageObj->setVar('page_author', $xoopsUser->getVar('uid'));
        $pageObj->setVar('page_pushtime', time());

        /* removed - this is now done during module install/update
        require_once $helper->path("include/functions.php");
        if (aboutmkdirs(XOOPS_UPLOAD_PATH . "/{$moduleDirName}")) {
            $upload_path = XOOPS_UPLOAD_PATH . "/{$moduleDirName}";
        }
        */

        $upload_path = XOOPS_UPLOAD_PATH . "/{$moduleDirName}";

        // Upload image
        if (!empty($_FILES['userfile']['name'])) {
            require_once XOOPS_ROOT_PATH . '/class/uploader.php';
            $allowed_mimetypes = ['image/gif', 'image/jpeg', 'image/jpg', 'image/png', 'image/x-png'];
            $maxfilesize       = 500000;
            $maxfilewidth      = 1200;
            $maxfileheight     = 1200;
            $uploader          = new \XoopsMediaUploader($upload_path, $allowed_mimetypes, $maxfilesize, $maxfilewidth, $maxfileheight);
            if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
                $uploader->setPrefix('attch_');
                if (!$uploader->upload()) {
                    $error_upload = $uploader->getErrors();
                } elseif (file_exists($uploader->getSavedDestination())) {
                    if ($pageObj->getVar('page_image')) {
                        @unlink($upload_path . '/' . $pageObj->getVar('page_image'));
                    }
                    $pageObj->setVar('page_image', $uploader->getSavedFileName());
                }
            }
        }

        // Delete image
        if (Request::hasVar('delete_image', 'POST') && empty($_FILES['userfile']['name'])) {
            @unlink($upload_path . '/' . $pageObj->getVar('page_image'));
            $pageObj->setVar('page_image', '');
        }

        // Insert object
        if ($pageHandler->insert($pageObj)) {
            $helper->redirect('admin/admin.page.php', Constants::REDIRECT_DELAY_MEDIUM, sprintf(_AM_ABOUT_SAVEDSUCCESS, _AM_ABOUT_PAGE_INSERT));
        }

        echo $pageObj->getHtmlErrors();
        $format = 'p';
        $form   = require $helper->path('include/form.page.php');
        $form->display();

        break;
    case 'delete':
        $pageObj = $pageHandler->get($page_id);
        $image   = XOOPS_UPLOAD_PATH . "/{$moduleDirName}/" . $pageObj->getVar('page_image');
        if (Request::hasVar('ok', 'REQUEST') && Constants::CONFIRM_OK === $_REQUEST['ok']) {
            if ($pageHandler->delete($pageObj)) {
                if (file_exists($image)) {
                    @unlink($image);
                }
                $helper->redirect('admin/admin.page.php', Constants::REDIRECT_DELAY_MEDIUM, _AM_ABOUT_DELETESUCCESS);
            } else {
                echo $pageObj->getHtmlErrors();
            }
        } else {
            xoops_confirm(['ok' => Constants::CONFIRM_OK, 'id' => $pageObj->getVar('page_id'), 'op' => 'delete'], $_SERVER['REQUEST_URI'], sprintf(_AM_ABOUT_RUSUREDEL, $pageObj->getVar('page_menu_title')));
        }
        break;
}

require_once __DIR__ . '/admin_footer.php';
