<?php

declare(strict_types=1);

namespace Frontend\Classs\Repository;

use Frontend\Classs\Entity\Classs;
use Frontend\Classs\Entity\Grades;
use Frontend\Classs\Entity\Year;
use Doctrine\ORM;
use Doctrine\ORM\EntityRepository;

/**
 * Class YearRepository
 * @package Frontend\Classs\Repository
 */
class YearRepository extends EntityRepository
{
    /**
     * @param Year $year
     * @throws ORM\ORMException
     * @throws ORM\OptimisticLockException
     */
}
