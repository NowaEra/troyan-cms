<?php
declare(strict_types=1);

namespace App\Twig\Extension;

use SiteContextBundle\Context\SiteContextManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class TwigRoutingExtension
 * Package App\Twig\Extension
 */
class TwigRoutingExtension extends AbstractExtension
{
    /** @var UrlGeneratorInterface */
    private $generator;

    /** @var SiteContextManagerInterface */
    private $contextManager;

    /**
     * TwigRoutingExtension constructor.
     *
     * @param UrlGeneratorInterface       $generator
     * @param SiteContextManagerInterface $contextManager
     */
    public function __construct(UrlGeneratorInterface $generator, \SiteContextBundle\Context\SiteContextManagerInterface $contextManager)
    {
        $this->generator      = $generator;
        $this->contextManager = $contextManager;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('host_url', [$this, 'getUrl'])
        ];
    }

    public function getUrl(string $name, array $parameters = [], bool $schemeRelative = false, string $host = null): string
    {
        if (null === $host) {
            $host = $this->contextManager->getContext()->getHost();
        }
        $context = $this->generator->getContext();
        $context->setHost($host);
        $this->generator->setContext($context);

        return $this->generator->generate(
            $name,
            $parameters,
            $schemeRelative ? UrlGeneratorInterface::NETWORK_PATH : UrlGeneratorInterface::ABSOLUTE_URL
        );
    }
}
