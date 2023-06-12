<?php

namespace App\Controller;

use App\Entity\Conge;
use App\Entity\UserProfile;
use App\Form\CongeFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class receptionController extends AbstractController
{
    #[Route('/receptionlist', name: 'receptionlist')]

    public function receptionlistAction(ManagerRegistry $doctrine ) : Response
    {
        $reception = $doctrine->getRepository(Conge::class);
        $listreception=$reception->findAll();
        return $this->render('reception/receptionlist.html.twig',array('reception' => $listreception));
    }

/*
    #[Route('/demandeconge', name: 'demandeconge')]
    public function demandecongeAction(ManagerRegistry $doctrine ,Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $iduser = $this->getUser()->getId();
        $userprofile = $doctrine->getRepository(UserProfile::class)->findOneBy(array('id' => $iduser));
        $repository = $doctrine->getRepository(Conge::class);
        $conge = new Conge() ;
        $form = $this->createForm(CongeFormType::class, $conge);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $datedebut=$form->get('start_day')->getData() ;
            $datefin= $form->get('end_day')->getData() ;
            //calculer la différence entre deux date
            $date3 = strtotime($datedebut);
            $date4 = strtotime($datefin);
            $nbJoursTimestamp = $date4 - $date3;
            $nbJours = round($nbJoursTimestamp / 86400) + 1;
            $conge->setStartDay($form->get('start_day')->getData());
            $conge->setEndDay($form->get('end_day')->getData());
            $conge->setTypeConge($form->get('type_conge')->getData());
            $conge->setStatuts("en attente");
            $conge->setDiscription($form->get('discription')->getData());
            $conge->setNombredujour($nbJours);
            $conge->setUserProfile($userprofile);
            $entityManager->persist($conge);
            $entityManager->flush();
            return $this->redirectToRoute('congelist');
        }
        return $this->render('conge/demandeconge.html.twig',['registrationForm' => $form->createView(),]);
    }
*/

}