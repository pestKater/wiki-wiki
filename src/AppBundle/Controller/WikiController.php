<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class WikiController extends Controller
{
    /**
     * @Route("/historisches", name="wiki")
     * #@Security("has_role('ROLE_USER')")
     */
    public function wikiAction(Request $request)
    {
        return $this->render('wiki/index.html.twig');
    }
}
