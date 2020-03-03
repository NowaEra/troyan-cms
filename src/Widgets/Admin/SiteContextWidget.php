<?php
declare(strict_types=1);

namespace App\Widgets\Admin;

use SiteContextBundle\Context\SiteContextManagerInterface;
use SiteContextBundle\Repository\SiteContextRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Twig\Environment;
use WidgetBundle\Model\SimpleContextFactory;
use WidgetBundle\Model\WidgetContextInterface;
use WidgetBundle\Widget\AbstractWidget;
use WidgetBundle\Widget\WidgetInterface;

/**
 * Class SiteContextWidget
 * Package App\Widgets\Admin
 */
class SiteContextWidget extends AbstractWidget implements WidgetInterface
{
    /** @var Environment */
    private $twig;

    /** @var SimpleContextFactory */
    private $factory;

    /** @var SiteContextRepository */
    private $contextRepository;

    /** @var SiteContextManagerInterface */
    private $siteContextManager;

    /**
     * SiteContextWidget constructor.
     *
     * @param Environment                 $twig
     * @param SimpleContextFactory        $factory
     * @param SiteContextRepository       $contextRepository
     * @param SiteContextManagerInterface $siteContext
     */
    public function __construct(Environment $twig, SimpleContextFactory $factory, SiteContextRepository $contextRepository, SiteContextManagerInterface $siteContext)
    {
        $this->twig               = $twig;
        $this->factory            = $factory;
        $this->contextRepository  = $contextRepository;
        $this->siteContextManager = $siteContext;
    }

    public function configureOptions(OptionsResolver $optionsResolver): void
    {
        $optionsResolver
            ->setDefined(['template', 'sites', 'currentContext'])
            ->setRequired('template')
            ->setDefault('template', $this->getTemplate())
            ->setAllowedTypes('template', ['string'])
            ->setAllowedTypes('sites', ['array'])
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
        return 'admin/widget/site_context_widget.html.twig';
    }

    public function getNewInstance(): WidgetContextInterface
    {
        $currentContext = $this->siteContextManager->getContext();

        return $this->factory->fromArray(
            $this->id,
            [
                'sites'          => $this->getSites(),
                'currentContext' => $currentContext
            ]
        );
    }

    private function getSites(bool $filterCurrent = true): array
    {
        iF (true === $filterCurrent) {
            return $this->contextRepository->findExcluding(
                $this->siteContextManager->getContext()
            );
        }

        return $this->contextRepository->findAll();
    }
}
