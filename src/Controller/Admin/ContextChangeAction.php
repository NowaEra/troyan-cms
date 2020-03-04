<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use SiteContextBundle\Context\SiteContextManagerInterface;
use SiteContextBundle\Repository\SiteContextRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class ContextChangeAction
 * @package App\Controller\Admin
 */
class ContextChangeAction
{
    const RETURN_PARAMETER = 'return';

    /** @var SiteContextManagerInterface */
    private $siteContext;

    /** @var SiteContextRepository */
    private $repository;

    /** @var RouterInterface */
    private $router;

    /**
     * ContextController constructor.
     *
     * @param SiteContextManagerInterface $siteContext
     * @param SiteContextRepository       $repository
     * @param RouterInterface             $router
     */
    public function __construct(SiteContextManagerInterface $siteContext, SiteContextRepository $repository, RouterInterface $router)
    {
        $this->siteContext = $siteContext;
        $this->repository  = $repository;
        $this->router      = $router;
    }

    public function __invoke(int $contextId, Request $request): Response
    {
        $site = $this->repository->findOneBy(['id' => $contextId]);
        $this->siteContext->updateContext($site);
        $requestContext = $this->router->getContext();
        $requestContext->setHost($site->getHost());
        $this->router->setContext($requestContext);
        $redirectPath = $this->router->generate(
            $request->query->get('returnRoute'),
            $request->query->get('returnRouteParams', []),
            RouterInterface::ABSOLUTE_URL
        )
        ;

        return new RedirectResponse($redirectPath);
    }
}
