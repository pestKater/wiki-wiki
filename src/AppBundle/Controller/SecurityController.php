<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();

        if($error) {
            $error = $error->getMessage();
            $this->addFlash(
                'error',
                $this->get('translator')->trans($error)
            );
        }

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'security/login.html.twig',
            array(
                'last_username' => $lastUsername,
            )
        );
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function login_checkAction()
    {
        // The security layer will intercept this request, else redirect to login page
        $this->addFlash('warning', $this->get('translator')->trans('login_expired'));
        return $this->redirect($this->generateUrl('login'));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        // The security layer will intercept this request, else redirect to login page
        $this->addFlash('warning', $this->get('translator')->trans('login_expired'));
        return $this->redirect($this->generateUrl('login'));
    }

    /**
     * @Route("/registrieren", name="register")
     */
    public function registerAction(Request $request)
    {
        // Building the form
        $form = $this->createFormBuilder()
            ->add('username', TextType::class , array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('email', EmailType::class, array(
                'attr' => array('class' => 'form-control'),
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array('attr' => array('class' => 'form-control')),
            ))
            ->add('terms', CheckboxType::class, array(
            ))
            ->add('newsletter', CheckboxType::class, array(
                'required'  => false,
            ))
            ->getForm()
        ;

        $form->handleRequest($request);
        if($form->isValid()) {

            $formdata = $form->getData();

            $succesfullyRegistered = $this->register($formdata['email'], $formdata['username'], $formdata['plainPassword'], $formdata['newsletter']);

            if($succesfullyRegistered) {
                $this->addFlash(
                    'notice',
                    $this->get('translator')->trans('Dein Account wurde erstellt')
                );

                return $this->redirectToRoute('index');
            } else {
                $this->addFlash(
                    'error',
                    $this->get('translator')->trans('Dein Account konnte nicht angelegt werden')
                );
            }
        }

        return $this->render('security/register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param $email
     * @param $username
     * @param $password
     * @return bool
     */
    public function register($email, $username, $password, $newsletter)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user_exist = $userManager->findUserByUsernameOrEmail($email);

        if($user_exist) {
            return false;
        }

        $user = $userManager->createUser();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setEmailCanonical($email);
        $user->setLocked(0);
        $user->setEnabled(1); // Kann sich mit späterer Email-Authetifizierung ändern
        $user->setPlainPassword($password);
        $user->setNewsletter($newsletter);
        $userManager->updateUser($user);

        return true;
    }
}
