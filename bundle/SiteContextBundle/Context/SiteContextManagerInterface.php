<?php

namespace SiteContextBundle\Context;

use App\Entity\SiteContext;

/**
 * Class SiteContext
 * @package SiteContextBundle\Context
 */
interface SiteContextManagerInterface
{
    public function updateContext(SiteContext $context): void;

    public function hasContext(): bool;

    public function getContext(): ?SiteContext;
}
