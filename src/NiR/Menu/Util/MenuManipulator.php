<?php

namespace NiR\Menu\Util;

use Knp\Menu\ItemInterface;

class MenuManipulator
{
    public function sort(ItemInterface $item)
    {
        $item->setChildren($this->sortChildren($item->getChildren()));
    }

    private function sortChildren(array $children)
    {
        if (empty($children)) {
            return [];
        }

        $key  = 0;
        $sort = [$this, 'sort'];

        $children = array_map(function (ItemInterface $item, $label) use(&$key, $sort) {
            call_user_func($sort, $item);

            return [$item->getExtra('weight', 0), $key++, $item, $label];
        }, $children, array_keys($children));

        array_multisort($children);

        $sorted = [];

        foreach ($children AS $child) {
            $sorted[$child[3]] = $child[2];
        }

        return $sorted;
    }
}
