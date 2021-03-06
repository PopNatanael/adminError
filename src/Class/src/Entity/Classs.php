<?php

/**
 * @see https://github.com/dotkernel/frontend/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/frontend/blob/master/LICENSE.md MIT License
 */

declare(strict_types=1);

namespace Frontend\Classs\Entity;

use Frontend\App\Entity\AbstractEntity;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Classs
 * @package Frontend\Frontend\Classs\Entity
 *
 * @ORM\Entity(repositoryClass="Frontend\Classs\Repository\ClassRepository")
 * @ORM\Table(name="class")
 * @ORM\HasLifecycleCallbacks
 * @package Frontend\Classs\Entity
 */
class Classs extends AbstractEntity
{
    public const PLATFORM_WEBSITE = 'website';
    public const PLATFORM_ADMIN = 'admin';
    public const STATUS_ACTIVE = "active";

    /**
     * @ORM\Column(name="name", type="string", length=150)
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(name="status", type="string", length=150)
     * @var string
     */
    protected $status;

    /**
     * @ORM\OneToOne(targetEntity="Frontend\Classs\Entity\Year")
     * @ORM\JoinColumn(name="year", referencedColumnName="uuid", nullable=false)
     * @var Year
     */
    protected Year $year;

    /**
     * Message constructor.
     * @param string $name
     * @param string $status
     * @param string $year
     */
    public function __construct(
        string $name,
        string $status,
        Year $year
    ) {
        parent::__construct();

        $this->name = $name;
        $this->status = self::STATUS_ACTIVE;
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    // public function getYear()
    // {
    //     return $this->year;
    // }

    /**
     * @return string
     */
    public function getPlatform(): string
    {
        return $this->platform;
    }

    /**
     * @param string $platform
     */
    public function setPlatform(string $platform): void
    {
        $this->platform = $platform;
    }
}
