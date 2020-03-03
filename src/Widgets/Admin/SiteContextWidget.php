<?php
declare(strict_types=1);

namespace App\Widgets\Admin;

use App\Context\SiteContext;
use App\Context\SiteContext as SiteContextService;
use App\Repository\SiteContextRepository;
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

    /** @var SiteContext */
    private $siteContextService;

    /**
     * SiteContextWidget constructor.
     *
     * @param Environment           $twig
     * @param SimpleContextFactory  $factory
     * @param SiteContextRepository $contextRepository
     * @param SiteContext           $siteContext
     */
    public function __construct(Environment $twig, SimpleContextFactory $factory, SiteContextRepository $contextRepository, SiteContextService $siteContext)
    {
        $this->twig               = $twig;
        $this->factory            = $factory;
        $this->contextRepository  = $contextRepository;
        $this->siteContextService = $siteContext;
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
        $currentContext = $this->siteContextService->getContext();

        return $this->factory->fromArray(
            $this->id,
            [
                'sites'          => array_filter(
                    $this->getSites(),
                    function (\App\Entity\SiteContext $context) use ($currentContext) {
                        return $currentContext !== $context;
                    }
                ),
                'currentContext' => $currentContext
            ]
        );
    }

    private function getSites(bool $filterCurrent = true): array
    {
        iF (true === $filterCurrent) {
            return $this->contextRepository->findExcluding(
                $this->siteContextService->getContext()
            );
        }

        return $this->contextRepository->findAll();
    }
}
