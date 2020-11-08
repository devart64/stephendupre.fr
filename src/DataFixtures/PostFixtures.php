<?php


namespace App\DataFixtures;

use App\Application\Entity\Comment;
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
        for ($i = 1; $i <= 100; $i++){
            $post = new Post();
            $post->setTitle('Article n°'.$i);
            $post->setContent('Contenu n°'.$i);
            $post->setAuthor('Stephen');
            $manager->persist($post);

            for ($j = 1; $j <= rand(2, 15); $j++) {
                $comment = new Comment();
                $comment->setAuthor('Auteur '.rand(2, 15));
                $comment->setContent('Commentaire n°'.$j);
                $comment->setPost($post);
                $manager->persist($comment);
            }
        }
        $manager->flush();
    }
}