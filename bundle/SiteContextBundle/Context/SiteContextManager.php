<?php
declare(strict_types=1);

namespace SiteContextBundle\Context;

use SiteContextBundle\Entity\BaseContext;
use SiteContextBundle\Repository\SiteContextRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class SiteContext
 * @package SiteContextBundle\Context
 */
class SiteContextManager implements SiteContextManagerInterface
{
    const CONTEXT_ID_PARAMETER   = 'cms_admin.context.id';
    const CONTEXT_HOST_PARAMETER = 'cms_admin.context.host';

    /** @var SessionInterface */
    private $session;

    /** @var SiteContextRepository */
    private $contextRepository;

    /** @var BaseContext */
    private $context;

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

    public function updateContext(BaseContext $context): void
    {
        $this->session->set(self::CONTEXT_ID_PARAMETER, $context->getId());
        $this->session->set(self::CONTEXT_HOST_PARAMETER, $context->getHost());
        $this->context = $context;
    }

    public function hasContext(): bool
    {
        return $this->session->has(self::CONTEXT_ID_PARAMETER)
            && $this->session->has(self::CONTEXT_HOST_PARAMETER);
    }

    public function getContext(): ?BaseContext
    {
        if (false === $this->hasContext()) {
            return null;
        }

        if (null === $this->context) {
            $this->context = $this->contextRepository->findOneBy(
                ['id' => $this->session->get(self::CONTEXT_ID_PARAMETER)]
            );
        }

        return $this->context;
    }
}
