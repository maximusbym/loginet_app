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
        $topicId = $data->topic->getId();

        $query = $em->createQuery(
            "SELECT c
            FROM AppBundle:Comment c
            WHERE c.topic = {$topicId} AND c.name = {$data->name} AND c.email = {$data->email}
            ORDER BY c.created_at DESC
            "
        );

        $lastUserComment = $query->getResult();
        $data->setCreatedAt = new \DateTime();

        if( !$lastUserComment ) {
            $em->persist($data);
        }
        else {
            $lastUserComment->comment .= '<br/>---ADDED---<br/>' . $data->comment;
            $em->persist($lastUserComment);
        }

        $em->flush();
        return true;
    }
}