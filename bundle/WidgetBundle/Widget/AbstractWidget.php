<?php
declare(strict_types=1);

namespace WidgetBundle\Widget;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use WidgetBundle\Model\WidgetContextInterface;

/**
 * Class AbstractWidget
 * @package WidgetBundle\Widget
 */
abstract class AbstractWidget implements WidgetInterface
{
    public function configureCreateForm(FormBuilderInterface $builder, WidgetContextInterface $context): void
    {
    }

    public function configureEditForm(FormBuilderInterface $builder, WidgetContextInterface $context): void
    {
    }

    public function validateErrors(FormBuilderInterface $builder, Request $request)
    {
    }
}
