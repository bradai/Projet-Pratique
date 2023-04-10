<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class Paginator
{
    private $paginator;
    private $entityManager;

    public function __construct(PaginatorInterface $paginator, EntityManagerInterface $entityManager)
    {
        $this->paginator = $paginator;
        $this->entityManager = $entityManager;
    }

    public function paginate(string $entityClass, Request $request, int $itemsPerPage = 5)
    {
        $queryBuilder = $this->entityManager->getRepository($entityClass)->createQueryBuilder('e');
        return $this->paginator->paginate($queryBuilder, $request->query->getInt('page', 1), $itemsPerPage);
    }
}