<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class MainController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('main/index.html.twig');
    }


    /**
     * @Route("/ajax/getTopics", name="getTopics")
     */
    public function getTopicsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $topics = $em->getRepository('AppBundle:Topic')->findAllForAjax();

        $response = new JsonResponse();

        $response->setData( array( 'data' => $topics ) );
        return $response;
    }



}
