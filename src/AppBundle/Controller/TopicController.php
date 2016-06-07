<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\CommentType;

class TopicController extends Controller
{
    /**
     * @Route("/topic/{id}")
     */
    public function indexAction($id, Request $request)
    {
        $form = $this->createForm(CommentType::class, array());
        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
            $this->get('app.comments_manager')->saveComment($data);
        }

        $em = $this->getDoctrine()->getManager();
        $topic = $em->getRepository('AppBundle:Topic')->find($id);

        return $this->render('AppBundle:Topic:topic_page.html.twig', array(
            'form' => $form->createView(), 'topic' => $topic
        ));
    }

}
