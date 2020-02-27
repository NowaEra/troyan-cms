<?php
declare(strict_types=1);

namespace WidgetBundle\Widget;

use WidgetBundle\Exception\WidgetException;

/**
 * Class WidgetRepository
 * Package WidgetBundle\Widget
 */
class WidgetRepository
{
    /** @var WidgetInterface[] */
    private $widgets = [];

    public function registerWidget(string $id, WidgetInterface $widget): void
    {
        if (true === $this->has($id)) {
            return;
        }
        $this->widgets[$id] = $widget;
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->widgets);
    }

    public function get(string $id): WidgetInterface
    {
        if (false === $this->has($id)) {
            throw WidgetException::createForWidgetNotFound($id);
        }

        return $this->widgets[$id];
    }
}
