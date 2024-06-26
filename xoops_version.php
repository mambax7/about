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
use XoopsModules\About\Utility;

require_once __DIR__ . '/preloads/autoloader.php';

$moduleDirName = basename(__DIR__);
$moduleDirNameUpper = \mb_strtoupper($moduleDirName);

$modversion['version']       = '1.7.0';
$modversion['module_status'] = 'Beta 3';
$modversion['release_date']  = '2024/06/01';
$modversion['name']          = _MI_ABOUT_NAME;
$modversion['description']   = _MI_ABOUT_DESC;
$modversion['author']        = 'Magic.Shao, ezsky, Mamba, Zyspec';
$modversion['credits']       = 'xoops.org.cn';
$modversion['help']          = 'page=help';
$modversion['license']       = 'GNU GPL 2.0 or later';
$modversion['license_url']   = 'www.gnu.org/licenses/gpl-2.0.html';
$modversion['dirname']             = $moduleDirName;
$modversion['modicons16']          = 'assets/images/icons/16';
$modversion['modicons32']          = 'assets/images/icons/32';
$modversion['module_website_url']  = 'www.xoops.org';
$modversion['module_website_name'] = 'XOOPS';
$modversion['min_php']             = '7.4';
$modversion['min_xoops']           = '2.5.11';
$modversion['min_admin']           = '1.2';
$modversion['min_db']              = ['mysql' => '5.5'];

$modversion['image'] = 'assets/images/logoModule.png';
$modversion['hasAdmin']    = 1;
$modversion['system_menu'] = 1;
$modversion['adminindex']  = 'admin/index.php';
$modversion['adminmenu']   = 'admin/menu.php';

// Is performing module install/update?
$isModuleAction            = (!empty($_POST['fct']) && 'modulesadmin' === $_POST['fct']);
$modversion['onInstall']   = 'include/action.module.php';
$modversion['onUpdate']    = 'include/action.module.php';
$modversion['onUninstall'] = 'include/action.module.php';

// Menu
$modversion['hasMain'] = 1;
global $xoopsModuleConfig, $xoopsUser, $xoopsModule;

//sql
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables']           = ['about_page',];

// ------------------- Templates ------------------- //
if ($isModuleAction) {
//    require_once __DIR__ . '/include/functions.render.php';
    $modversion['templates'] = Utility::getTplPageList('', true);
}

//$modversion['templates'] = [
//    ['file' => 'about_admin_page.tpl', 'description' => ''],
//    ['file' => 'about_list.tpl', 'description' => ''],
//    ['file' => 'about_menu.tpl', 'description' => ''],
//    ['file' => 'about_page.tpl', 'description' => ''],
//];

// ------------------- Blocks ------------------- //
$modversion['blocks'][] = [
    'file'        => 'blocks.php',
    'name'        => _MI_ABOUT_ABOUTUS,
    'description' => '',
    'show_func'   => 'about_block_menu_show',
    'options'     => '',
    'edit_func'   => '',
    'template'    => 'about_block_menu.tpl',
];

/*
 * @param int $options[0] page id
 * @param int $options[1] text subStr number
 * @param int $options[2] if show page image
 * @param int $options[3] more link text
 */

$modversion['blocks'][] = [
    'file'        => 'blocks.php',
    'name'        => _MI_ABOUT_PAGE,
    'description' => '',
    'show_func'   => 'about_block_page_show',
    'options'     => '1|0|[more]|0',
    'edit_func'   => 'about_block_page_edit',
    'template'    => 'about_block_page.tpl',
];

// Module Configs
$modversion['config'][] = [
    'name'        => 'display',
    'title'       => '_MI_ABOUT_CONFIG_LIST',
    'description' => '',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'options'     => [
        '_MI_ABOUT_CONFIG_LIST_PAGE'     => Constants::PAGE,
        '_MI_ABOUT_CONFIG_LIST_CATEGORY' => Constants::CATEGORY,
    ],
    'default'     => Constants::PAGE,
];

$modversion['config'][] = [
    'name'        => 'str_ereg',
    'title'       => '_MI_ABOUT_CONFIG_STR_EREG',
    'description' => '',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => Constants::DEFAULT_EREG,
];

xoops_load('xoopseditorhandler');
$editorHandler          = XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name'        => 'editorAdmin',
    'title'       => '_MI_ABOUT_EDITOR',
    'description' => '_MI_ABOUT_EDITOR_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'options'     => array_flip($editorHandler->getList()),
    'default'     => 'dhtmltextarea',
];
