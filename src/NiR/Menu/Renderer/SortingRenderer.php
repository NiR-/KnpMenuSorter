<?php

namespace NiR\Menu\Renderer;

use Knp\Menu\ItemInterface;
use Knp\Menu\Renderer\RendererInterface;
use NiR\Menu\Util\MenuManipulator;

/**
 * Renderer decorator that sorts menu items right before rendering
 */
class SortingRenderer implements RendererInterface
{
    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * @var MenuManipulator
     */
    private $manipulator;

    /**
     * @var RendererInterface $renderer    The decorated renderer
     * @var MenuManipulator   $manipulator
     */
    public function __construct(RendererInterface $renderer, MenuManipulator $manipulator)
    {
        $this->renderer    = $renderer;
        $this->manipulator = $manipulator;
    }

    /**
     * {@inheritdoc}
     */
    public function render(ItemInterface $item, array $options = [])
    {
        $this->manipulator->sort($item);

        return $this->renderer->render($item, $options);
    }
}
