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
 * @author         Susheng Yang <ezskyyoung@gmail.com>
 */
require_once XOOPS_ROOT_PATH . '/class/xoopsform/form.php';

/**
 * Class BlockForm
 */
class BlockForm extends \XoopsForm
{
    /**
     * BlockForm constructor.
     */
    public function __construct()
    {
    }

    /**
     * create HTML to output the form as a table
     */
    public function render(): string
    {
        $ret    = '<div>';
        $hidden = '';
        foreach ($this->getElements() as $ele) {
            if (!\is_object($ele)) {
                $ret .= $ele;
            } elseif (!$ele->isHidden()) {
                if ('' !== ($caption = $ele->getCaption())) {
                    $ret .= "<div class='xoops-form-element-caption" . ($ele->isRequired() ? '-required' : '') . "'>" . "<span class='caption-text'><strong>{$caption}</strong></span>" . "<span class='caption-marker'>*</span>" . '</div>';
                }

                $ret .= "<div style='margin:5px 0 8px 0; '>" . $ele->render() . "</div>\n";
            } else {
                $hidden .= $ele->render();
            }
        }
        $ret .= '</div>';
        $ret .= $this->renderValidationJS(true);

        return $ret;
    }
}
