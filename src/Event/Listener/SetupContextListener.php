<?php
declare(strict_types=1);

namespace App\Event\Listener;

use App\Exception\Context\ContextException;
use SiteContextBundle\Context\SiteContextManagerInterface;
use SiteContextBundle\Repository\SiteContextRepository;
use Symfony\Component\HttpKernel\Event\RequestEvent;

/**
 * Class SetupContextListener
 * Package App\Event\Listener
 */
class SetupContextListener
{
    /** @var SiteContextRepository */
    private $contextRepository;

    /** @var SiteContextManagerInterface */
    private $contextManager;

    /**
     * SetupContextListener constructor.
     *
     * @param SiteContextRepository       $contextRepository
     * @param SiteContextManagerInterface $contextManager
     */
    public function __construct(SiteContextRepository $contextRepository, SiteContextManagerInterface $contextManager)
    {
        $this->contextRepository = $contextRepository;
        $this->contextManager    = $contextManager;
    }

    public function onRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $host    = $request->getHost();

        if (0 === strpos($request->getPathInfo(), '/admin')) {
            if (true === $this->contextManager->hasContext() && $host === $this->contextManager->getContext()->getHost()) {
                return;
            }
        }
        $context = $this->contextRepository->findOneByHost($request->getHost());
        if (null === $context) {
            throw ContextException::createForUnresolvedContextForHost(
                $request->getHost()
            );
        }
        $this->contextManager->updateContext($context);
    }

}
