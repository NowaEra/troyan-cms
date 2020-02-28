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

    /** @var array */
    private $aliases = [];

    public function registerWidget(string $id, WidgetInterface $widget, string $alias = null): void
    {
        if (true === $this->has($id)) {
            return;
        }

        if (null !== $alias && false === $this->hasAlias($alias)) {
            $this->aliases[$alias] = $id;
        }

        $this->widgets[$id] = $widget;
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->widgets);
    }

    public function hasAlias(string $alias): bool
    {
        return array_key_exists($alias, $this->aliases);
    }

    public function get(string $id): WidgetInterface
    {
        if (true === $this->hasAlias($id)) {
            return $this->get($this->aliases[$id]);
        }

        if (false === $this->has($id)) {
            throw WidgetException::createForWidgetNotFound($id);
        }

        return $this->widgets[$id];
    }
}
