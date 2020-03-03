<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Class SiteContext
 * Package App\Entity
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class SiteContext
{
    use TimestampableEntity;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=false, unique=true)
     */
    private $host;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=false, unique=true)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default": 0})
     */
    private $enabled = false;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getHost(): ?string
    {
        return $this->host;
    }

    /**
     * @param string|null $host
     */
    public function setHost(?string $host): void
    {
        $this->host = $host;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return SiteContext
     */
    public function setName(?string $name): SiteContext
    {
        $this->name = $name;

        return $this;
    }
}
