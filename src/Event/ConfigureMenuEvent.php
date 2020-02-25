<?php
declare(strict_types=1);

namespace App\Event;

use Knp\Menu\ItemInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class ConfigureMenuEvent
 * Package App\Event
 */
class ConfigureMenuEvent extends Event
{
    /** @var ItemInterface */
    private $menu;

    /** @var string */
    private $translationDomain;

    /**
     * ConfigureMenuEvent constructor.
     *
     * @param ItemInterface $menu
     * @param string        $translationDomain
     */
    public function __construct(ItemInterface $menu, string $translationDomain)
    {
        $this->menu              = $menu;
        $this->translationDomain = $translationDomain;
    }

    /**
     * @return ItemInterface
     */
    public function getMenu(): ItemInterface
    {
        return $this->menu;
    }

    /**
     * @return string
     */
    public function getTranslationDomain(): string
    {
        return $this->translationDomain;
    }
}
