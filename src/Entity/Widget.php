<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use WidgetBundle\Entity\AbstractBaseWidget;

/**
 * Class ApplicationWidget
 * Package App\Entity
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Widget extends AbstractBaseWidget
{
    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
