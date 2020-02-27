<?php
declare(strict_types=1);

namespace WidgetBundle\Model;

/**
 * Interface WidgetContextInterface
 * @package WidgetBundle\Model
 */
interface WidgetContextInterface
{
    public function setData(array $data): WidgetContextInterface;

    public function getData(): array;

    public function getWidgetKey(): string;
    public function mergeConfiguration(array $configuration = []): WidgetContextInterface;
}
