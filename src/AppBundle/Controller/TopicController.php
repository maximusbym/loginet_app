<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Form\CommentType;

class TopicController extends Controller
{
    /**
     * @Route("/topic/{id}")
     */
    public function indexAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $topic = $em->getRepository('AppBundle:Topic')->find($id);

        $form = $this->createForm(CommentType::class);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $data->setTopic($topic);
            $this->get('app.comments_manager')->saveComment($data);
  
            unset($form);
            $form = $this->createForm(CommentType::class);
        }

        $bannedWords = $em->getRepository('AppBundle:BannedWord')->findAll();

        return $this->render('Topic/topic_page.html.twig', array(
            'form' => $form->createView(), 'topic' => $topic, 'bannedWords' => $bannedWords
        ));
    }

    /**
     * @Route("/ajax/getTopicComments/{id}", name="getTopicComments")
     */
    public function getTopicCommentsAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $comments = $em->getRepository('AppBundle:Comment')->findAllByTopicForAjax($id);

        $response = new JsonResponse();

        $response->setData( array( 'data' => $comments ) );
        return $response;
    }

}
