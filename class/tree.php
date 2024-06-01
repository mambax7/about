<?php declare(strict_types=1);

namespace XoopsModules\About;

require_once XOOPS_ROOT_PATH . '/class/tree.php';

if (!\class_exists('About\Tree')) {
    /**
     * Class Tree
     */
    class Tree extends \XoopsObjectTree
    {
        /**
         * Tree constructor.
         * @param array $objectArr
         * @param null  $rootId
         */
        public function __construct($objectArr, $rootId = null)
        {
            parent::__construct($objectArr, 'page_id', 'page_pid', $rootId);
        }

        /**
         * @param int        $key
         * @param mixed      $ret
         * @param string     $prefix_orig
         * @param string     $prefix_curr
         * @param array|null $tags
         */
        public function makeTreeItems(int $key, &$ret, string $prefix_orig, string $prefix_curr = '', array $tags = null): void
        {
            if ($key > 0) {
                if ($tags && \is_array($tags)) {
                    foreach ($tags as $tag) {
                        $ret[$key][$tag] = $this->tree[$key]['obj']->getVar($tag);
                    }
                } else {
                    $ret[$key]['page_title'] = $this->tree[$key]['obj']->getVar('page_title');
                }
                $ret[$key]['prefix'] = $prefix_curr;
                $prefix_curr         .= $prefix_orig;
            }
            if (isset($this->tree[$key]['child']) && !empty($this->tree[$key]['child'])) {
                foreach ($this->tree[$key]['child'] as $childkey) {
                    $this->makeTreeItems($childkey, $ret, $prefix_orig, $prefix_curr, $tags);
                }
            }
        }

        /**
         * @param null   $tags
         */
        public function &makeTree(string $prefix = '-', int $key = 0, $tags = null): array
        {
            $ret = [];
            $this->makeTreeItems($key, $ret, $prefix, '', $tags);

            return $ret;
        }

        /**
         * @param string $name
         * @param string $fieldName
         * @param string $prefix
         * @param string $selected
         * @param bool   $addEmptyOption
         * @param int    $key
         * @param string $extra
         */
        public function makeSelBox(
            $name,
            $fieldName,
            $prefix = '-',
            $selected = '',
            $addEmptyOption = false,
            $key = 0,
            $extra = ''
        ): string {
            $ret = '<select name=' . $name . '>';
            if (!empty($addEmptyOption)) {
                $ret .= '<option value="0">' . (\is_string($addEmptyOption) ? $addEmptyOption : '') . '</option>';
            }
            $this->makeSelBoxOptions('page_title', $selected, $key, $ret, $prefix);
            $ret .= '</select>';

            return $ret;
        }

        /**
         * @param mixed $ret
         */
        public function getAllChildArray(int $key, &$ret, array $tags = [], int $depth = 0): void
        {
            if (0 === --$depth) {
                return;
            }

            if (isset($this->tree[$key]['child'])) {
                foreach ($this->tree[$key]['child'] as $childkey) {
                    if (isset($this->tree[$childkey]['obj'])) :
                        if ($tags && \is_array($tags)) {
                            foreach ($tags as $tag) {
                                $ret['child'][$childkey][$tag] = $this->tree[$childkey]['obj']->getVar($tag);
                            }
                        } else {
                            $ret['child'][$childkey]['page_title'] = $this->tree[$childkey]['obj']->getVar('page_title');
                        }
                    endif;

                    $this->getAllChildArray($childkey, $ret['child'][$childkey], $tags, $depth);
                }
            }
        }

        /**
         * @param array|null $tags
         */
        public function makeArrayTree(int $key = 0, array $tags = null, int $depth = 0): array
        {
            $ret = [];
            if ($depth > 0) {
                $depth++;
            }
            if (isset($tags)) {
                $this->getAllChildArray($key, $ret, $tags, $depth);
            } else {
                $this->getAllChildArray($key, $ret, [], $depth);
            }

            return $ret;
        }
    }
}
