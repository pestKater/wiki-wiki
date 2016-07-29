<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class CommunityController extends Controller
{
    /**
     * @Route("/miteinander", name="community")
     * #@Security("has_role('ROLE_USER')")
     */
    public function wikiAction(Request $request)
    {
        return $this->render('community/index.html.twig');
    }
}
