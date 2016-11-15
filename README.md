# KnpMenuSorter

This library provides a `Renderer` decorator for `KnpMenu` library. This decorator will sorts your menu items in an ascendant order, based on a `weight` parameter.

## Installation

```bash
$ composer require nir/knp-menu-sorter
```

## Getting Started

```php
<?php

use Knp\Menu\MenuFactory;
use Knp\Menu\Renderer\ListRenderer;
use NiR\Menu\Renderer\SortingRenderer;
use NiR\Menu\Util\MenuManipulator;

$factory = new MenuFactory();
$menu = $factory->createItem('My menu');
$menu->addChild('Coming soon', ['extras' => ['weight' => 20]]);
$menu->addChild('Comments', ['uri' => '#comments', 'extras' => ['weight' => 5]]);
$menu->addChild('Symfony2', ['uri' => 'http://symfony-reloaded.org/', 'extras' => ['weight' => 10]]);
$menu->addChild('Home', ['uri' => '/']);

$renderer = new SortingRenderer(
  new ListRenderer(new \Knp\Menu\Matcher\Matcher()),
  new MenuManipulator()
);
echo $renderer->render($menu);
```

The above menu would render the following HTML:

```html
<ul>
  <li class="first">
    <a href="/">Home</a>
  </li>
  <li class="current">
    <a href="#comments">Comments</a>
  </li>
  <li>
    <a href="http://symfony-reloaded.org/">Symfony2</a>
  </li>
  <li class="last">
    <span>Coming soon</span>
  </li>
</ul>
```
