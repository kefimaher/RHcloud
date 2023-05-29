<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserProfile;
use App\Form\ProfileFormType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends AbstractController
{

    #[Route('/emplooyeslist', name: 'emplooyeslist')]
    public function listemployerAction(ManagerRegistry $doctrine): Response
    {
        $Userprofile = $doctrine->getRepository(UserProfile::class);
        $listiserprofile = $Userprofile->findAll();
        $User = $doctrine->getRepository(User::class);
        $listuser = $User->findAll();
        return $this->render('employees/emplooyeslist.html.twig', array('users' => $listuser, 'profiles' => $listiserprofile));
    }


    #[Route('/profilecomplet/{id}', name: 'profilecomplet')]
    public function profile($id,Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
     //   $userprofile = $em->getRepository('SocieteBundle:Conge')->findOneBy(array('id' => $id));
        echo ($id) ;
        die();
        $userprofile = new UserProfile();


        $form = $this->createForm(ProfileFormType::class, $userprofile);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $userprofile->setAdresse($form->get('adresse')->getData());
            $userprofile->setContractType($form->get('contracttype')->getData());
            $userprofile->setStatus($form->get('status')->getData());
            $userprofile->setDateofbirth($form->get('dateofbirth')->getData());
            $userprofile->setCountrycode($form->get('countrycode')->getData());
            $userprofile->setMedicalfilenumber($form->get('medicalfilenumber')->getData());
            $userprofile->setJoindate($form->get('joindate')->getData());
            $userprofile->setCurrentrank($form->get('currentrank')->getData());
            $userprofile->setTelephone($form->get('telephone')->getData());
            $userprofile->setUpperhierarchy($form->get('upperhierarchy')->getData());
            return $this->redirectToRoute('dashbroad');

            // $entityManager->persist($user);
            // $entityManager->flush();
        }

           return $this->render('employees/profile.html.twig', ['registrationForm' => $form->createView(),]);
    }

}