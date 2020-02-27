<?php
declare(strict_types=1);

namespace WidgetBundle\Widget;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use WidgetBundle\Model\WidgetContextInterface;

/**
 * Interface WidgetInterface
 * @package WidgetBundle\Widget
 */
interface WidgetInterface
{
    public function configureOptions(OptionsResolver $optionsResolver): void;
    public function execute(WidgetContextInterface $context, array $resolvedData): Response;
    public function getTemplate(): string;
}
