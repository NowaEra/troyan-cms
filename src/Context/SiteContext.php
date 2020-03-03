<?php
declare(strict_types=1);

namespace App\Context;

use App\Entity\SiteContext as SiteContextEntity;
use App\Repository\SiteContextRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class AdminSiteContext
 * Package App\Context
 */
class SiteContext
{
    const CONTEXT_ID_PARAMETER   = 'cms_admin.context.id';
    const CONTEXT_HOST_PARAMETER = 'cms_admin.context.host';

    /** @var SessionInterface */
    private $session;

    /** @var SiteContextRepository */
    private $contextRepository;

    /**
     * AdminSiteContext constructor.
     *
     * @param SessionInterface      $session
     * @param SiteContextRepository $contextRepository
     */
    public function __construct(SessionInterface $session, SiteContextRepository $contextRepository)
    {
        $this->session           = $session;
        $this->contextRepository = $contextRepository;
    }

    public function updateContext(SiteContextEntity $context): void
    {
        $this->session->set(self::CONTEXT_ID_PARAMETER, $context->getId());
        $this->session->set(self::CONTEXT_HOST_PARAMETER, $context->getHost());
    }

    public function getContext(): SiteContextEntity
    {
        return $this->contextRepository->findOneBy(
            ['id' => $this->session->get(self::CONTEXT_ID_PARAMETER)]
        );
    }
}
