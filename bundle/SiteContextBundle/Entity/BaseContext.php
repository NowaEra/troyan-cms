<?php
declare(strict_types=1);

namespace SiteContextBundle\Entity;

use App\Entity\SiteContext;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class BaseContext
 * Package SiteContextBundle\Entity
 */
abstract class BaseContext
{
    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=false, unique=true)
     */
    protected $host;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=false, unique=true)
     */
    protected $name;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default": 0})
     */
    protected $enabled = false;

    /**
     * @return int|null
     */
    abstract public function getId(): ?int;

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
