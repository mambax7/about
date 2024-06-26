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
use XoopsModules\About;
use XoopsModules\About\Constants;
use XoopsModules\About\PageHandler;
use XoopsModules\About\Utility;

/** @var Helper $helper */
/** @var PageHandler $pageHandler */
defined('XOOPS_ROOT_PATH') || exit('Restricted access');

//require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

$pageType = isset($_REQUEST['type']) ? Request::getInt('type', 0) : $pageObj->getVar('page_type');
$format   = empty($format) ? 'e' : $format;

$menu_status = $pageObj->isNew() ? 1 : $pageObj->getVar('page_menu_status');
$list_status = $pageObj->isNew() ? 1 : $pageObj->getVar('page_status');
$page_blank  = $pageObj->isNew() ? 0 : $pageObj->getVar('page_blank');

$title = $pageObj->isNew() ? _AM_ABOUT_PAGE_INSERT : _AM_ABOUT_EDIT;

$form = new \XoopsThemeForm($title, 'form', 'admin.page.php', 'post', true);
$form->setExtra('enctype="multipart/form-data"');

if (Constants::PAGE_TYPE_PAGE === $pageType) {
    $form->addElement(new \XoopsFormText(_AM_ABOUT_PAGE_TITLE, 'page_title', 60, 255, $pageObj->getVar('page_title', $format)), true);
    $menu = new \XoopsFormElementTray(_AM_ABOUT_PAGE_MENU_LIST);

    $menu->addElement(new \XoopsFormRadioYN('', 'page_menu_status', $menu_status));
    $menu->addElement(new \XoopsFormText(_AM_ABOUT_PAGE_MENU_TITLE . ':', 'page_menu_title', 30, 255, $pageObj->getVar('page_menu_title', $format)));
    $menu->addElement(new \XoopsFormLabel('', _AM_ABOUT_PAGE_LINK_MENU));
    $form->addElement($menu, true);

    $editorTray = new \XoopsFormElementTray(_AM_ABOUT_PAGE_TEXT, '<br>');
    if (class_exists('XoopsFormEditor')) {
        $options['name']   = 'page_text';
        $options['value']  = $pageObj->getVar('page_text');
        $options['rows']   = 25;
        $options['cols']   = '100%';
        $options['width']  = '100%';
        $options['height'] = '400px';
        $pageEditor        = new \XoopsFormEditor('', $helper->getConfig('editorAdmin'), $options, $nohtml = false, $onfailure = 'textarea');
        $editorTray->addElement($pageEditor);
    } else {
        $pageEditor = new \XoopsFormDhtmlTextArea('', 'page_text', $pageObj->getVar('page_text'));
        $editorTray->addElement($pageEditor);
    }
    $form->addElement($editorTray);

    // Template set
    $templates = Utility::getTemplateList('page');
    if ($templates && \is_array($templates)) {
        $template_select = new \XoopsFormSelect(_AM_ABOUT_TEMPLATE_SELECT, 'page_tpl', $pageObj->getVar('page_tpl'));
        $template_select->addOptionArray($templates);
        $form->addElement($template_select);
    }
} else {
    $form->addElement(new \XoopsFormText(_AM_ABOUT_PAGE_MENU_TITLE . ':', 'page_menu_title', 60, 255, $pageObj->getVar('page_menu_title', $format)));
    $form->addElement(new \XoopsFormHidden('page_menu_status', $menu_status));
    $form->addElement(new \XoopsFormText(_AM_ABOUT_PAGE_LINK_TEXT, 'page_text', 60, 255, $pageObj->isNew() ? XOOPS_URL . $pageObj->getVar('page_text', $format) : $pageObj->getVar('page_text', $format)), true);
}

// Get list of possible parent pages
$page_list = $pageHandler->getTrees(0, '--');
if (!$pageObj->isNew()) {
    $child_list = $pageHandler->getTrees($pageObj->getVar('page_id'));
    $page_list  = array_diff_key($page_list, $child_list);  // remove this class' children from 'parent' list
    unset($page_list[$pageObj->getVar('page_id')]);        // remove this id from 'parent' list
}
$page_options = [];
if ($page_list) {
    foreach ($page_list as $id => $page) {
        $page_options[$id] = $page['prefix'] . $page['page_menu_title'];
    }
}
$page_select = new \XoopsFormSelect(_AM_ABOUT_PAGE_HIGHER, 'page_pid', $pageObj->getVar('page_pid'));
$page_select->addOption(0, _NONE);
$page_select->addOptionArray($page_options);
$form->addElement($page_select);

$image_tray     = new \XoopsFormElementTray(_AM_ABOUT_PAGE_IMAGE);
$image_uploader = new \XoopsFormFile('', 'userfile', 500000);
$image_tray->addElement($image_uploader);
$pageImage = $pageObj->getVar('page_image');
if (!empty($pageImage) && file_exists(XOOPS_ROOT_PATH . '/uploads/' . $xoopsModule->dirname() . '/' . $pageImage)) {
    $image_tray->addElement(new \XoopsFormLabel('', '<div style="padding: 8px;"><img src="' . XOOPS_URL . '/uploads/' . $xoopsModule->dirname() . '/' . $pageImage . '"></div>'));
    $delete_check = new \XoopsFormCheckBox('', 'delete_image');
    $delete_check->addOption(1, _DELETE);
    $image_tray->addElement($delete_check);
}
$form->addElement($image_tray);
$form->addElement(new \XoopsFormRadioYN(_AM_ABOUT_PAGE_LINK_BLANK, 'page_blank', $page_blank));
$form->addElement(new \XoopsFormRadioYN(_AM_ABOUT_PAGE_STATUS, 'page_status', $list_status, $yes = _AM_ABOUT_PAGE_SUB, $no = _AM_ABOUT_PAGE_DRAFT));

$form->addElement(new \XoopsFormHidden('id', $pageObj->getVar('page_id')));
$form->addElement(new \XoopsFormHidden('page_type', $pageType));
$form->addElement(new \XoopsFormHidden('op', 'save'));
//$form->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
$form->addElement(new \XoopsFormButtonTray('submit', _SUBMIT, 'submit'));

return $form;
