<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Context\SiteContext;
use App\Repository\SiteContextRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ContextChangeAction
 * @package App\Controller\Admin
 */
class ContextChangeAction
{
    const RETURN_PARAMETER = 'return';

    /** @var SiteContext */
    private $siteContext;

    /** @var SiteContextRepository */
    private $repository;

    /**
     * ContextController constructor.
     *
     * @param SiteContext           $siteContext
     * @param SiteContextRepository $repository
     */
    public function __construct(SiteContext $siteContext, SiteContextRepository $repository)
    {
        $this->siteContext = $siteContext;
        $this->repository  = $repository;
    }

    public function __invoke(int $contextId, Request $request): Response
    {
        if (false === $request->query->has(self::RETURN_PARAMETER)) {
            return new Response(
                sprintf(
                    'Query parameter "%s" must be set in order to redirect.',
                    self::RETURN_PARAMETER
                ), Response::HTTP_BAD_REQUEST
            );
        }

        $site = $this->repository->findOneBy(['id' => $contextId]);
        $this->siteContext->updateContext($site);

        return new RedirectResponse($request->query->get(self::RETURN_PARAMETER));
    }
}
