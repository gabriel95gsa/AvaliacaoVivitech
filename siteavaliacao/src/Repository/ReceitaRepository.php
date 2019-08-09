<?php

namespace App\Repository;

use App\Entity\Receita;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Receita|null find($id, $lockMode = null, $lockVersion = null)
 * @method Receita|null findOneBy(array $criteria, array $orderBy = null)
 * @method Receita[]    findAll()
 * @method Receita[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReceitaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Receita::class);
    }

     /**
     * @return Receita[] Returns an array of Receita objects
     */
    public function findByUser($usuario)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.usuario = :val')
            ->setParameter('val', $usuario)
            ->orderBy('r.data', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Receita[] Returns an array of Receita objects
     */
    public function findByMesAtual($usuario) {
        $data_inicio = mktime(0, 0, 0, date('m') , 1 , date('Y'));
        $data_inicio = date('Y-m-d', $data_inicio);
        $data_fim = mktime(23, 59, 59, date('m'), date("t"), date('Y'));
        $data_fim = date('Y-m-d', $data_fim);

        return $this->createQueryBuilder('r')
            ->andWhere('r.data BETWEEN :data_inicio AND :data_fim AND r.usuario = :usuario')
            ->setParameter('usuario', $usuario)
            ->setParameter('data_inicio', $data_inicio)
            ->setParameter('data_fim', $data_fim)
            ->orderBy('r.data', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
}
