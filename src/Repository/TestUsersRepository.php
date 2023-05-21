<?php

namespace App\Repository;

use App\lib\Pagination;
use App\Entity\TestUsers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<TestUsers>
 *
 * @method TestUsers|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestUsers|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestUsers[]    findAll()
 * @method TestUsers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TestUsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestUsers::class);
    }

    public function save(TestUsers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TestUsers $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByCondition(array $condition=[]): array
    {
        $qb = $this->createQueryBuilder('tu')
            ->orderBy('tu.id', 'ASC');
        if (isset($condition['isActive'])) {
            $qb->andWhere('tu.is_active = :isActive')
            ->setParameter('isActive', $condition['isActive']);
        }
        if (isset($condition['isMember'])) {
            $qb->andWhere('tu.is_member = :isMember')
            ->setParameter('isMember', $condition['isMember']);
        }
        if($condition['lastLoginAtFrom']){
            $qb->andWhere('tu.last_login_at > :lastLoginAtFrom')
            ->setParameter('lastLoginAtFrom', $condition['lastLoginAtFrom']);
        }
        if($condition['lastLoginAtTo']){
            $qb->andWhere('tu.last_login_at < :lastLoginAtTo')
            ->setParameter('lastLoginAtTo', $condition['lastLoginAtTo']);
        }
        if($condition['userType']){
            $qb->andWhere($qb->expr()->in('tu.user_type', $condition['userType']));
        }
        $page = $condition['page']?:1;
        $perPage = $condition['perPage']?:10;

        $pagination = new Pagination($qb, $page,$perPage,$fetchJoinCollection = true);
        if($pagination->datas) foreach($pagination->datas as $testuser){
            $testuser->setPassword('');
        }
        return $pagination->toArray();
    }

//    /**
//     * @return TestUsers[] Returns an array of TestUsers objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TestUsers
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
