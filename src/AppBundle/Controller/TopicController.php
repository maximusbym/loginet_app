<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TopicController extends Controller
{
    /**
     * @Route("/topic/{id}")
     */
    public function indexAction($id)
    {
        return $this->render('AppBundle:Topic:topic_page.html.twig', array(
            // ...
        ));
    }

}
