<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     * #@Security("has_role('ROLE_USER')")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig');
    }
}
