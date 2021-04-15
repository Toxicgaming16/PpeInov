<?php

namespace App\Repository;

use App\Entity\Theme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Theme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Theme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Theme[]    findAll()
 * @method Theme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThemeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Theme::class);
    }

    // /**
    //  * @return Theme[] Returns an array of Theme objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Theme
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function nbVocaParTheme()
    {
        $qb = $this->createQueryBuilder('t')
        ->select('COUNT(v.id) as Nombre, t.libelle as themes')
        ->from('App\Entity\Vocabulaire', "v", 'App\Entity')
            ->where('v.id = t.id')
            ->groupBy('t.libelle')
            ;
        $query = $qb->getQuery();
        return $query->execute();

        $conn=$this->getEntityManager()->getConnection();
        $sql='
        SELECT COUNT(v.id) as Nombre, t.libelle as themes
        FROM vocabulaire v, theme t, theme_vocabulaire tv
        WHERE v.id = tv.vocabulaire_id AND tv.theme_id = t.id
        GROUP BY t.libelle
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['theme' => $theme]);

        return $stmt->fetchAll();
    }

}
