<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        $cookie = $request->cookies->get('LandingpageSeen');

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            if(!isset($cookie)) {
                return $this->redirectToRoute('landingpage');
            }
        }

        return $this->render('default/index.html.twig');
    }
    /**
     * @Route("/landingpage", name="landingpage")
     */
    public function landingPageAction(Request $request)
    {
        $response = new Response();
        $response->headers->setCookie(new Cookie("LandingpageSeen", true, time() + 7200));
        $response->sendHeaders();
        
        return $this->render('landingPage.html.twig');
    }
}
