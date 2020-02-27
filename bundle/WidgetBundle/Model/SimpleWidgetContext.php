<?php
declare(strict_types=1);

namespace WidgetBundle\Model;

/**
 * Class SimpleWidgetContext
 * Package WidgetBundle\Model
 */
class SimpleWidgetContext implements WidgetContextInterface
{

    /** @var */
    private $data;

    /** @var string */
    private $widgetKey;

    /**
     * SimpleWidgetContext constructor.
     *
     * @param string $widgetKey
     */
    public function __construct(string $widgetKey)
    {
        $this->widgetKey = $widgetKey;
    }

    public function setData(array $data): WidgetContextInterface
    {
        $this->data = $data;

        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getWidgetKey(): string
    {
        $this->widgetKey;
    }

    public function mergeConfiguration(array $configuration = []): WidgetContextInterface
    {
        $this->data = array_merge($this->data, $configuration);

        return $this;
    }
}
