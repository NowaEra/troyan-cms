<?php
declare(strict_types=1);

namespace App\Widgets\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Twig\Environment;
use WidgetBundle\Model\SimpleContextFactory;
use WidgetBundle\Model\WidgetContextInterface;
use WidgetBundle\Widget\AbstractWidget;
use WidgetBundle\Widget\WidgetInterface;

/**
 * Class SideMenuWidget
 * Package App\Widgets\Admin
 */
class SideMenuWidget extends AbstractWidget implements WidgetInterface
{
    /** @var Environment */
    private $twig;

    /** @var SimpleContextFactory */
    private $factory;

    /** @var string */
    private $id;

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * SideMenuWidget constructor.
     *
     * @param Environment          $twig
     * @param SimpleContextFactory $factory
     */
    public function __construct(Environment $twig, SimpleContextFactory $factory)
    {
        $this->twig    = $twig;
        $this->factory = $factory;
    }

    public function configureOptions(OptionsResolver $optionsResolver): void
    {
        $optionsResolver
            ->setDefined(['template'])
            ->setRequired('template')
            ->setDefault('template', $this->getTemplate())
            ->setAllowedTypes('template', ['string'])
        ;
    }

    public function execute(WidgetContextInterface $context, array $resolvedData): Response
    {
        $data     = $context->getData();
        $html     = $this->twig->render($resolvedData['template'], $data);
        $response = new Response($html);

        return $response;
    }

    public function getTemplate(): string
    {
        return 'admin/widget/side_menu_widget.html.twig';
    }

    public function getNewInstance(): WidgetContextInterface
    {
        return $this->factory->fromArray($this->id, []);
    }
}
