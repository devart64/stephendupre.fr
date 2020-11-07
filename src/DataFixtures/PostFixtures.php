<?php


namespace App\DataFixtures;

use App\Application\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class PostFixtures
 * @package App\DataFixtures
 */
class PostFixtures extends Fixture
{

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 50; $i++){
            $post = new Post();
            $post->setTitle('Article n°'.$i);
            $post->setContent('Contenu n°'.$i);
            $manager->persist($post);
        }
        $manager->flush();
    }
}