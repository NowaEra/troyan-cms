<?php
declare(strict_types=1);

namespace App\Menu\Admin;

use App\Event\ConfigureMenuEvent;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

/**
 * Class AdminMenuBuilder
 * @package App\Menu\Admin
 */
class AdminMenuBuilder
{
    /** @var string */
    private static $translationDomain = 'admin_menu';

    /** @var FactoryInterface */
    private $factory;

    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    /**
     * @param FactoryInterface         $factory
     *
     * Add any other dependency you need
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(FactoryInterface $factory, EventDispatcherInterface $eventDispatcher)
    {
        $this->factory         = $factory;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param array $options
     *
     * @return ItemInterface
     */
    public function sidebarMenu(array $options = []): ItemInterface
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'c-sidebar-nav');
        $this->eventDispatcher->dispatch(
            new ConfigureMenuEvent($menu, self::$translationDomain)
        );

        return $menu;
    }

    public static function setDefaultMenuAttributes(ItemInterface $item, string $translationDomain = null): void
    {
        if (null === $translationDomain) {
            $translationDomain = self::$translationDomain;
        }
        $item->setExtra('translation_domain', $translationDomain);
        $item->setAttribute('class', 'c-sidebar-nav-item');
        $item->setLinkAttribute('class', 'c-sidebar-nav-link');
    }
}
