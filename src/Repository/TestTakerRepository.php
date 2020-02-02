<?php

namespace App\Repository;

use App\Entity\TestTaker;
use Doctrine\ORM\EntityRepository;

class TestTakerRepository extends EntityRepository
{
    public function getAllTestTakers()
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select("tt")
            ->from(TestTaker::class, "tt")
            ->getQuery()
            ->getArrayResult()
        ;
    }
}