<?php
declare(strict_types=1);

namespace App\Event\Listener;

use App\Event\ConfigureMenuEvent;
use App\Menu\Admin\AdminMenuBuilder;
use Knp\Menu\FactoryInterface;

/**
 * Class AdminMenuListener
 * Package App\Event\Listener
 */
class AdminMenuListener
{
    /** @var FactoryInterface */
    private $factory;

    /**
     * AdminMenuListener constructor.
     *
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param ConfigureMenuEvent $event
     */
    public function onMenu(ConfigureMenuEvent $event): void
    {
        $menu = $this->factory->createItem(
            'admin.admin_menu.dashboard.label',
            ['route' => 'admin']
        );
        $menu->setExtra('icon', 'build/@coreui/sprites/free.svg#cil-speedometer');
        AdminMenuBuilder::setDefaultMenuAttributes($menu);
        $event->getMenu()->addChild($menu);
    }
}
