<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $article = new Article();
        $article->setTitle('This is the first article');
        $article->setBody("This is the first article. This time generated with fixtures");
        $manager->persist($article);
        $article2 = new Article();
        $article2->setTitle('This is the second article');
        $article2->setBody("This is the second article. This time generated with fixtures");
        $manager->persist($article2);

        $manager->flush();
    }
}
