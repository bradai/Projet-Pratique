<?php


// src/DataFixtures/FactureFixtures.php

namespace App\DataFixtures;

use App\Entity\Facture;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class FactureFixtures extends Fixture implements DependentFixtureInterface
{


    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $articles = $manager->getRepository(Article::class)->findAll();

        // Créer 10 factures
        for ($i = 0; $i < 10; $i++) {
            $facture = new Facture();
            $facture->setDesignation($faker->sentence($nbWords = 3, $variableNbWords = true));
            $facture->setDescription($faker->text($maxNbChars = 20));
            $facture->setPrixTotalHT($faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100));

            // Ajouter de 1 à 5 articles aléatoires à chaque facture
            $randomKeys = array_rand($articles, 3);

            foreach ($randomKeys as $key) {
                $facture->addArticle($articles[$key]);
            }

            $manager->persist($facture);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ArticleFixtures::class,
        ];
    }
}
