<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoginController
{

    #[Route('/dashbroad', name: 'dashbroad')]
    public function dashbroadAction( )
    {
     //   $User = $doctrine -> getRepository(User::class);
     //   $listuser=$User ->findAll();    array('users' => $listuser)
        return $this->render('dashbroad/dashbroad.html.twig');
    }


}