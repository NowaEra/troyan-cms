<?php

namespace SiteContextBundle\Context;

use SiteContextBundle\Entity\BaseContext;

/**
 * Class SiteContext
 * @package SiteContextBundle\Context
 */
interface SiteContextManagerInterface
{
    public function updateContext(BaseContext $context): void;

    public function hasContext(): bool;

    public function getContext(): ?BaseContext;
}
