<?php
namespace App\Controller;
use App\Entity\Conge;
use App\Entity\UserProfile;
use App\Form\CongeFormType;
use App\Form\ProfileFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
class CongeController extends  AbstractController
{
    #[Route('/congelist', name: 'congelist')]
    public function congeslistAction(ManagerRegistry $doctrine ) : Response
    {
        $conge = $doctrine->getRepository(Conge::class);
        $listconge=$conge->findAll();
        return $this->render('conge/congelist.html.twig',array('conges' => $listconge));
    }

    #[Route('/demandeconge', name: 'demandeconge')]
    public function demandecongeAction(ManagerRegistry $doctrine ,Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $repository = $doctrine->getRepository(Conge::class);
        $conge = new Conge() ;
        $form = $this->createForm(CongeFormType::class, $conge);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
        }
        return $this->render('conge/demandeconge.html.twig',['registrationForm' => $form->createView(),]);
    }

/*
    #[Route('/profilecomplet/{id}', name: 'profilecomplet')]
    public function profile(ManagerRegistry $doctrine , $id,Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
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
            $userprofile->setUpperhierarchy($form->get('upperhierarchy')->getData());
            $entityManager->persist($userprofile);
            $entityManager->flush();
            return $this->redirectToRoute('dashbroad');
        }
        return $this->render('employees/profile.html.twig', ['registrationForm' => $form->createView(),]);
    }






   /*
    #[Route('/mesdemande', name: 'mesdemande')]
    public function mesdemandeAction(ManagerRegistry $doctrine ) : Response
    {
        return $this->render('conge/demandeconge.html.twig');
    }
   */



}


