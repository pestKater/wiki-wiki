<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class PagesController extends Controller
{
    /**
     * @Route("/team", name="team")
     */
    public function teamAction(Request $request)
    {
        return $this->render('pages/team.html.twig');
    }

    /**
     * @Route("/support", name="support")
     */
    public function supportAction(Request $request)
    {
        return $this->render('pages/support.html.twig');
    }

    /**
     * @Route("/Nutzungsbedingungen", name="agb")
     */
    public function agbAction(Request $request)
    {
        return $this->render('pages/agb.html.twig');
    }

    /**
     * @Route("/datenschutz", name="privacy")
     */
    public function privacyAction(Request $request)
    {
        return $this->render('pages/privacy.html.twig');
    }

    /**
     * @Route("/impressum", name="impressum")
     */
    public function impressumAction(Request $request)
    {
        return $this->render('pages/impressum.html.twig');
    }
}
