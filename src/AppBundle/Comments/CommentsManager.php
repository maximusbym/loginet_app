<?php
namespace AppBundle\Comments;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Comment;

class CommentsManager
{
    protected $em;
    public function __construct($em)
    {
        $this->em = $em;
    }

    public function saveComment($data)
    {
        $em = $this->em;

        $lastUserComment = $this->getLastUserComment($data);

        if( !$lastUserComment ) {
            $em->persist($data);
        }
        else {
            $pinnedText = $lastUserComment->getComment() . '<br/>---ADDED---<br/>' . $data->getComment();
            $lastUserComment->setComment($pinnedText);
            $em->persist($lastUserComment);
        }

        $em->flush();
        
        return true;
    }

    private function getLastUserComment($userData) {

        $em = $this->em;
        $topicId = $userData->getTopic()->getId();
        $userName = $userData->getName();
        $userEmail = $userData->getEmail();

        $query = $em->createQuery(
            "SELECT c
            FROM AppBundle:Comment c
            WHERE c.topic = {$topicId}
            ORDER BY c.createdAt DESC"
        )->setMaxResults(1);

        $last = $query->getResult();

        return isset( $last[0] ) && $last[0]->getName() == $userName && $last[0]->getEmail() == $userEmail ? $last[0] : null ;
    }





}