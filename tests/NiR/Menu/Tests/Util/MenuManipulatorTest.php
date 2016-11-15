<?php

namespace NiR\Menu\Tests\Util;

use Knp\Menu\MenuFactory;
use Knp\Menu\MenuItem;
use NiR\Menu\Util\MenuManipulator;

class MenuManipulatorTest extends \PHPUnit_Framework_TestCase
{
    public function testRecursivelySortTree()
    {
        $menu = new MenuItem('root', new MenuFactory());
        $menu->addChild('c2');
        $menu->addChild('c4', array('extras' => array('weight' => 20)));
        $menu->addChild('c3', array('extras' => array('weight' => 20)));
        $c1 = $menu->addChild('c1', array('extras' => array('weight' => 10)));

        $c1->addChild('c11');
        $c1->addChild('c12', array('extras' => array('weight' => -5)));

        $manipulator = new MenuManipulator();
        $manipulator->sort($menu);
        $this->assertEquals(array('c2', 'c1', 'c4', 'c3'), array_keys($menu->getChildren()));
        $this->assertEquals(array('c12', 'c11'), array_keys($menu->getChild('c1')->getChildren()));
    }
}
