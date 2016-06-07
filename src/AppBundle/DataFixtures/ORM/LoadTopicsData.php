<?php
namespace AppBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Topic;
use AppBundle\Entity\Comment;
use Faker\Factory as Faker;
class LoadBonusCardData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker::create();

        $topics = array('PHP', 'MySQL', 'HTML', 'CSS', 'JavaScript');

        foreach ( $topics as $topicTitle ) {
            
            $topic = new Topic();
            $topic->setTitle($topicTitle);
            
            $manager->persist($topic);
            
            $commentItems = rand(3,12);
            for( $k=0; $k<$commentItems; $k++ ){
                $fakedDate = $faker->dateTimeBetween('-1 year', 'now');

                $comment = new Comment();
                $comment->setTopic($topic);
                $comment->setComment($faker->text(200));
                $comment->setCreatedAt($fakedDate);
                $comment->setEmail($faker->email);
                $comment->setName($faker->name);

                $manager->persist($comment);
            }
        }

        $manager->flush();
    }

}