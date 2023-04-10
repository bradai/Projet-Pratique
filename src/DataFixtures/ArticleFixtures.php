<?php


// src/DataFixtures/ArticleFixtures.php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        // Créer 10 articles
        for ($i = 0; $i < 10; $i++) {
            $article = new Article();
            $article->setNom('article-'.$i);
            $article->setPrix($faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100));
            $manager->persist($article);
        }

        $manager->flush();
    }
}
