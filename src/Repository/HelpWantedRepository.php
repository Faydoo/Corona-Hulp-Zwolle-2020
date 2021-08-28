<?php

namespace App\Repository;

use App\Entity\HelpWanted;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HelpWanted|null find($id, $lockMode = null, $lockVersion = null)
 * @method HelpWanted|null findOneBy(array $criteria, array $orderBy = null)
 * @method HelpWanted[]    findAll()
 * @method HelpWanted[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HelpWantedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HelpWanted::class);
    }
}
