<?php

namespace App\Controller;

use App\Entity\Conge;
use App\Entity\Reception;
use App\Form\ReceptionFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class receptionController extends AbstractController
{
    #[Route('/demanderhlist', name: 'demanderhlist')]

    public function receptionlistAction(ManagerRegistry $doctrine ) : Response
    {
        $reception = $doctrine->getRepository(Reception::class);
        $listreception=$reception->findAll();
        return $this->render('demanderh/demanderhlist.html.twig',array('receptions' => $listreception));
    }
    #[Route('/demanderh', name: 'demanderh')]
    public function demandecongeAction(ManagerRegistry $doctrine ,Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $iduser = $this->getUser()->getId();
        $userprofile = $doctrine->getRepository(UserProfile::class)->findOneBy(array('id' => $iduser));
        $demanderh = new Reception() ;
        $form = $this->createForm(ReceptionFormType::class, $demanderh);
        $form->handleRequest($request);
        if ($form->isSubmitted())
        {
           /* $demanderh->setUserProfile($userprofile);
              $entityManager->persist($demanderh);
            $entityManager->flush();
            return $this->redirectToRoute('receptionlist');
           */
        }
        return $this->render('demanderh/demanderh.html.twig',['registrationForm' => $form->createView(),]);
    }


}