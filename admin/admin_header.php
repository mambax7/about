<?php declare(strict_types=1);
/*
 * You may not change or alter any portion of this comment or credits of
 * supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or
 * credit authors.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * Create and display the Administration Header for pages
 *
 * @copyright    https://xoops.org 2001-2017 XOOPS Project
 * @license      GNU GPL 2.0 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @author       XOOPS Module Development Team
 */

use Xmf\Module\Admin;
use XoopsModules\About\Helper;

/** @var Admin $adminObject */
/** @var Helper $helper */
require \dirname(__DIR__) . '/preloads/autoloader.php';

require \dirname(__DIR__, 3) . '/include/cp_header.php';
require \dirname(__DIR__) . '/include/common.php';

$moduleDirName = \basename(\dirname(__DIR__));

xoops_load('xoopsformloader');

$helper = Helper::getInstance();
$myts   = \MyTextSanitizer::getInstance();

$adminObject = Admin::getInstance();

if (!isset($GLOBALS['xoopsTpl']) || !($GLOBALS['xoopsTpl'] instanceof \XoopsTpl)) {
    require_once $GLOBALS['xoops']->path('class/template.php');
    $xoopsTpl = new \XoopsTpl();
}

// Load language files
$helper->loadLanguage('modinfo');
$helper->loadLanguage('main');
