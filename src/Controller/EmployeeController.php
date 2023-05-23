<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserProfile;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends AbstractController
{

    #[Route('/emplooyeslist', name: 'emplooyeslist')]
    public function listemployerAction(ManagerRegistry $doctrine ) : Response
    {

        $Userprofile = $doctrine -> getRepository(UserProfile::class);
        $listiserprofile = $Userprofile ->findAll() ;

        $User = $doctrine -> getRepository(User::class);
        $listuser=$User ->findAll();

        return $this->render('employees/emplooyeslist.html.twig', array('users' => $listuser,'profiles'  => $listiserprofile));
    }


}