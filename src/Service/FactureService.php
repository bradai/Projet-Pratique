<?php


namespace App\Service;

use App\Entity\Facture;
use App\Repository\FactureRepository;
use Doctrine\ORM\EntityManagerInterface;

class FactureService
{
    private $factureRepository;
    private $entityManager;

    public function __construct(FactureRepository $factureRepository, EntityManagerInterface $entityManager)
    {
        $this->factureRepository = $factureRepository;
        $this->entityManager = $entityManager;
    }

    public function getFactures()
    {
        return $this->factureRepository->findAll();
    }

    public function createFacture(Facture $facture)
    {
        $this->entityManager->persist($facture);
        $this->entityManager->flush();
    }

    public function updateFacture(Facture $facture)
    {
        $this->entityManager->persist($facture);
        $this->entityManager->flush();
    }

    public function deleteFacture(Facture $facture)
    {
        $this->entityManager->remove($facture);
        $this->entityManager->flush();
    }
}
