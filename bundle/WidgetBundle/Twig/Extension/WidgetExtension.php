<?php
declare(strict_types=1);

namespace WidgetBundle\Twig\Extension;

use Symfony\Component\HttpKernel\Fragment\FragmentHandler;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use WidgetBundle\Exception\WidgetException;
use WidgetBundle\Model\SimpleContextFactory;
use WidgetBundle\Model\WidgetContextInterface;
use WidgetBundle\Widget\WidgetRepository;

/**
 * Class WidgetExtension
 * Package WidgetBundle\Twig\Extension
 */
class WidgetExtension extends AbstractExtension
{
    /** @var WidgetRepository */
    private $repository;

    /** @var SimpleContextFactory */
    private $contextFactory;

    /**
     * WidgetExtension constructor.
     *
     * @param WidgetRepository     $repository
     * @param SimpleContextFactory $contextFactory
     */
    public function __construct(WidgetRepository $repository, SimpleContextFactory $contextFactory)
    {
        $this->repository     = $repository;
        $this->contextFactory = $contextFactory;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('cms_render_widget', [$this, 'renderWidget'], ['is_safe' => ['html']])
        ];
    }

    public function renderWidget($widget, array $options = []): string
    {
        $widgetService = null;
        $context       = null;

        if (true === $widget instanceof WidgetContextInterface) {
            /** @var WidgetContextInterface $widget */
            $widgetService = $this->repository->get($widget->getWidgetKey());
            $context       = $widget;
            $context->mergeConfiguration($options);
        }

        if (true === is_string($widget)) {
            /** @var string $widget */
            $widgetService = $this->repository->get($widget);
            $context       = $this->contextFactory->fromArray($widget, $options);
        }

        if (null === $widgetService) {
            throw WidgetException::throwForUnsupportedInput();
        }

        $optionsResolver = new OptionsResolver();
        $widgetService->configureOptions($optionsResolver);
        $data     = $optionsResolver->resolve($context->getData());
        $response = $widgetService->execute($context, $data);

        return (string) $response->getContent();
    }
}
