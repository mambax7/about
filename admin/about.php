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
 * Display the Administration About page
 *
 * @copyright  https://xoops.org 2001-2017 XOOPS Project
 * @license    GNU GPL 2.0 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @author     XOOPS Module Development Team
 */

use Xmf\Module\Admin;
/** @var Admin $adminObject */

require_once __DIR__ . '/admin_header.php';
xoops_cp_header();

$adminObject->displayNavigation(basename(__FILE__));
Admin::setPaypal('xoopsfoundation@gmail.com');
$adminObject->displayAbout(false);

require_once __DIR__ . '/admin_footer.php';
