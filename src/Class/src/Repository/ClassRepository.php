<?php

declare(strict_types=1);

namespace Frontend\Classs\Repository;

use Frontend\Classs\Entity\Classs;
use Frontend\Classs\Entity\Grades;
use Frontend\Classs\Entity\Year;
use Doctrine\ORM;
use Doctrine\ORM\EntityRepository;

/**
 * Class ClassRepository
 * @package Frontend\Classs\Repository
 */
class ClassRepository extends EntityRepository
{
    /**
     * @param Classs $class
     * @throws ORM\ORMException
     * @throws ORM\OptimisticLockException
     */
    public function saveClass(Classs $class)
    {
        $this->getEntityManager()->persist($class);
        $this->getEntityManager()->flush();
    }

    public function saveYear(Year $year)
    {
        $this->getEntityManager()->persist($year);
        $this->getEntityManager()->flush();
    }

    public function countClasses(string $search = null)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('count(year)')->from(Year::class, 'year');

        return $qb->getQuery()->useQueryCache(true)->getSingleScalarResult();
    }
    public function getClasses(
    int $offset = 0,
    int $limit = 30,
    string $search = null,
    string $sort = 'created',
    string $order = 'desc')
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('class')
            ->from(Classs::Class, 'class');
        $qb->setFirstResult($offset)->setMaxResults($limit);

        return $qb->getQuery()->useQueryCache(true)->getResult();
    }
}
