<?php
namespace App\Controller;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Form\ProfileFormType;
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
        // LIST OF ALL THE EMPLOYESS
        // ONLY ADMIN RH CAN WATCH THIS
        $Userprofile = $doctrine->getRepository(UserProfile::class);
        $listiserprofile = $Userprofile->findAll();
        $User = $doctrine->getRepository(User::class);
        $listuser = $User->findAll();
        return $this->render('employees/emplooyeslist.html.twig', array('users' => $listuser, 'profiles' => $listiserprofile));
    }
    #[Route('/profilecomplet/{id}', name: 'profilecomplet')]
    public function profile(ManagerRegistry $doctrine , $id,Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        // COPLETE OF ANY  USER PROFILE
        // ADMIN RH CAN COMPLETE ANY PROFILE
        // USER CAN COMPLETE ONLY HIS PROFILE  ==> NOT DEVLOPPED YET
       $repository = $doctrine->getRepository(UserProfile::class);
       $userprofile = $repository ->find($id);
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
            $userprofile->setSex($form->get('sex')->getData());
            $userprofile->setUpperhierarchy($form->get('upperhierarchy')->getData());
            $entityManager->persist($userprofile);
            $entityManager->flush();
            return $this->redirectToRoute('dashbroad');
        }
           return $this->render('employees/profile.html.twig', ['registrationForm' => $form->createView(),]);
    }

    // DELET PROFILE ==>   NOT DEVLOPPED YET
}