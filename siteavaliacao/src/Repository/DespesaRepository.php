<?php

namespace App\Repository;

use App\Entity\Despesa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Despesa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Despesa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Despesa[]    findAll()
 * @method Despesa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DespesaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Despesa::class);
    }

    /**
     * @return Despesa[] Returns an array of Despesa objects
     */
    public function findByUser($user)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.usuario = :val')
            ->setParameter('val', $user)
            ->orderBy('d.data', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Despesa[] Returns an array of Despesa objects
     */
    public function findByMesAtual($usuario) {
        $data_inicio = mktime(0, 0, 0, date('m') , 1 , date('Y'));
        $data_inicio = date('Y-m-d', $data_inicio);
        $data_fim = mktime(23, 59, 59, date('m'), date("t"), date('Y'));
        $data_fim = date('Y-m-d', $data_fim);

        return $this->createQueryBuilder('d')
            ->andWhere('d.data BETWEEN :data_inicio AND :data_fim AND d.usuario = :usuario')
            ->setParameter('usuario', $usuario)
            ->setParameter('data_inicio', $data_inicio)
            ->setParameter('data_fim', $data_fim)
            ->orderBy('d.data', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
}
