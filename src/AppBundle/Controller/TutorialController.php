<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class TutorialController extends Controller
{
    /**
     * @Route("/tutorial", name="tutorial")
     * #@Security("has_role('ROLE_USER')")
     */
    public function tutorialAction(Request $request)
    {
        return $this->render('tutorial/index.html.twig');
    }
}
