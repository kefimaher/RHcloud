<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserProfile;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/addemployee', name: 'addemployee')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $user->setRealpassword($form->get('plainPassword')->getData());

            $password = $form->get('plainPassword')->getData() ;
            $nom = $form->get('firstname')->getData() ;
            $prenom = $form->get('lastname')->getData() ;
            $fonction = $form->get('fonction')->getData() ;
            $email = $form->get('email')->getData() ;
            $employernumber = $form->get('employernumber')->getData() ;

            echo $password ;
            echo ('<br>') ;
            echo $nom ;
            echo ('<br>') ;
            echo $prenom ;
            echo ('<br>') ;
            echo $fonction ;
            echo ('<br>') ;
            echo $email ;
            echo ('<br>') ;
            echo $employernumber ;


            die();
            $user->setPassword($userPasswordHasher->hashPassword($user, $form->get('plainPassword')->getData()));
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('_profiler_home');
        }
        return $this->render('employees/addemployee.html.twig', [
            'registrationForm' => $form->createView(),
        ]);

    }
}
