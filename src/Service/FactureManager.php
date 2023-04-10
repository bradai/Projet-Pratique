<?php

namespace App\Service;

use App\Entity\Facture;
use Doctrine\ORM\EntityManagerInterface;

class FactureManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Facture $facture): void
    {
        $this->entityManager->persist($facture);
        $this->entityManager->flush();
    }

    public function remove(Facture $facture): void
    {
        $this->entityManager->remove($facture);
        $this->entityManager->flush();
    }
}
