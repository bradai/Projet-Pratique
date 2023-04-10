<?php


namespace App\Tests\Entity;

use App\Entity\Facture;
use PHPUnit\Framework\TestCase;
use App\Entity\Article;

class FactureTest extends TestCase
{
    public function testPrixTTC()
    {
        $facture = new Facture();
        $facture->setPrixTotalHT(100);
        $this->assertEquals(120, $facture->getPrixTotalTTC());
    }

    public function testTva()
    {
        $facture = new Facture();
        $facture->setPrixTotalHT(100);
        $this->assertEquals(20, ($facture->getPrixTotalTTC()*20)/100);
    }

    public function testGetPrixTotalTTC()
    {
        $facture = new Facture();

        $article1 = new Article();
        $article1->setPrix(100);
        $article2 = new Article();
        $article2->setPrix(200);

        $facture->addArticle($article1);
        $facture->addArticle($article2);

        $expectedTotalTTC = (100 * 1.2) + (200 * 1.2);
        $actualTotalTTC = $facture->getPrixTotalTTC(0.2);

        $this->assertEquals($expectedTotalTTC, $actualTotalTTC, "Le calcul du prix total TTC est incorrect.");
    }
}