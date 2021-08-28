<?php

namespace App\Repository;

use App\Entity\HelpWantedMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HelpWantedMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method HelpWantedMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method HelpWantedMessage[]    findAll()
 * @method HelpWantedMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HelpWantedMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HelpWantedMessage::class);
    }
}