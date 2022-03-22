<?php

declare(strict_types=1);

namespace Frontend\Classs\Repository;

use Frontend\Classs\Entity\Classs;
use Frontend\Classs\Entity\Grades;
use Frontend\Classs\Entity\Year;
use Doctrine\ORM;
use Doctrine\ORM\EntityRepository;

/**
 * Class GradesRepository
 * @package Frontend\Classs\Repository
 */
class GradesRepository extends EntityRepository
{
    /**
     * @param Grades $grades
     * @throws ORM\ORMException
     * @throws ORM\OptimisticLockException
     */
}
