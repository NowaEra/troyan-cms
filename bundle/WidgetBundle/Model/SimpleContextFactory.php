<?php
declare(strict_types=1);

namespace WidgetBundle\Model;

/**
 * Class SimpleModelFactory
 * Package WidgetBundle\Model
 */
class SimpleContextFactory
{
    public function fromArray(string $id, array $data): WidgetContextInterface
    {
        $context = new SimpleWidgetContext($id);
        $context->setData($data);

        return $context;
    }
}
