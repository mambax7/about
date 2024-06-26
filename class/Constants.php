<?php declare(strict_types=1);

namespace XoopsModules\About;

/*
               XOOPS - PHP Content Management System
                   Copyright (c) 2000 XOOPS.org
                      <https://xoops.org>
 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting
 source code which is considered copyrighted (c) material of the
 original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA
*/

/**
 * About module
 *
 * Class to define About Us constant values. These constants are
 * used to make the code easier to read and to keep values in central
 * location if they need to be changed.  These should not normally need
 * to be modified. If they are to be modified it is recommended to change
 * the value(s) before module installation. Additionally, the module may not
 * work correctly if trying to upgrade if these values have been changed.
 *
 * @copyright::  {@link https://xoops.org/ The XOOPS Project}
 * @license  ::    {@link https://www.gnu.org/licenses/gpl-2.0.html GNU Public License}
 * @author   ::     zyspec <zyspec@yahoo.com>
 * @since    ::      1.05
 **/

/**
 * interface Constants
 */
interface Constants
{
    /**#@+
     * Constant definition
     */
    /**
     * display - page
     */
    public const PAGE = 1;
    /**
     * display - category
     */
    public const CATEGORY = 2;
    /**
     * published
     */
    /**
     * Page - page type
     */
    public const PAGE_TYPE_PAGE = 1;
    /**
     * Link - page type
     */
    public const PAGE_TYPE_LINK = 2;
    /**
     * published
     */
    public const PUBLISHED = 1;
    /**
     * not published (draft)
     */
    public const NOT_PUBLISHED = 0;
    /**
     * display in menu
     */
    public const IN_MENU = 1;
    /**
     * do not display in menu
     */
    public const NOT_IN_MENU = 0;
    /**
     * Invalid ID
     */
    public const INVALID_ID = 0;
    /**
     * default ereg size
     */
    public const DEFAULT_EREG = 500;
    /**
     * default index for menu page
     */
    public const DEFAULT_INDEX = 1;
    /**
     * not index
     */
    public const NOT_INDEX = 0;
    /**
     * no delay XOOPS redirect delay (in seconds)
     */
    public const REDIRECT_DELAY_NONE = 0;
    /**
     * short XOOPS redirect delay (in seconds)
     */
    public const REDIRECT_DELAY_SHORT = 1;
    /**
     * medium XOOPS redirect delay (in seconds)
     */
    public const REDIRECT_DELAY_MEDIUM = 3;
    /**
     * long XOOPS redirect delay (in seconds)
     */
    public const REDIRECT_DELAY_LONG = 7;
    /**
     * confirm not ok to take action
     */
    public const CONFIRM_NOT_OK = 0;
    /**
     * confirm ok to take action
     */
    public const CONFIRM_OK = 1;
    /**
     * Set flag
     */
    public const SET = 1;
    /**
     * Unset flag
     */
    public const NOT_SET = 0;
    /**#@-*/
}
