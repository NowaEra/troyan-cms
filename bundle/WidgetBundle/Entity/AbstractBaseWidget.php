<?php
declare(strict_types=1);

namespace WidgetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use WidgetBundle\Model\WidgetContextInterface;

/**
 * Class Widget
 * @package WidgetBundle\Entity
 */
abstract class AbstractBaseWidget implements WidgetContextInterface
{
    use TimestampableEntity;
    /**
     * @var array
     *
     * @ORM\Column(type="array", nullable=false)
     */
    protected $data = [];

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    protected $widgetKey;

    /**
     * Widget constructor.
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

    public function mergeConfiguration(array $configuration = []): WidgetContextInterface
    {
        $this->data = array_merge($this->data, $configuration);
    }

    /**
     * @return string
     */
    public function getWidgetKey(): string
    {
        return $this->widgetKey;
    }

    /**
     * @return int|null
     */
    abstract public function getId(): ?int;
}
