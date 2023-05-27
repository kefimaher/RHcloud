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
      //  $userprofile = new UserProfile() ;
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {


    /*
            $numero=$form->get('numero')->getData();
            $nom=$form->get('nom')->getData();
            $prenom=$form->get('prenom')->getData();
            $poste=$form->get('poste')->getData();
            $email=$form->get('email')->getData();
            $password=$form->get('plainPassword')->getData() ;
            $adresse=$form->get('plainPassword')->getData();
            $typecontract=$form->get('plainPassword')->getData();
            $statut=$form->get('plainPassword')->getData();
            $adressepostal=$form->get('plainPassword')->getData();
            $datenaissance=$form->get('plainPassword')->getData();
            $grade=$form->get('plainPassword')->getData();
            $Telephone=$form->get('plainPassword')->getData();
            $fishiermediale=$form->get('plainPassword')->getData();
            $suph=$form->get('plainPassword')->getData();
            $datecontract=$form->get('plainPassword')->getData();



            echo ($numero) ;
            echo ($nom) ;
            echo ($prenom) ;
            echo ($poste) ;
            echo ($email) ;
            echo ($password) ;
            echo ($adresse) ;
            echo ($typecontract) ;
            echo ($statut) ;
            echo ($adressepostal) ;
            echo ($datenaissance) ;
            echo ($grade) ;
            echo ($Telephone) ;
            echo ($fishiermediale) ;
            echo ($suph) ;
            echo ($datecontract) ;

    */

            $user->setRealpassword($form->get('plainPassword')->getData());
            $user->setPassword($userPasswordHasher->hashPassword($user, $form->get('plainPassword')->getData()));

            echo ("maher");
            die() ;

            $entityManager->persist($user);
            $entityManager->flush();


            return $this->redirectToRoute('_profiler_home');
        }

        return $this->render('employees/addemployee.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
