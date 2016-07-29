<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    protected $plainPassword;

    /**
     * @ORM\Column(type="integer")
     */
    protected $newsletter;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    public function getNewsletter() {
        return $this->newsletter;
    }

    public function setNewsletter($newsletter) {
        $this->newsletter = $newsletter;
    }

    public function eraseCredentials()
    {
        //$this->setPlainPassword(null);
    }
}