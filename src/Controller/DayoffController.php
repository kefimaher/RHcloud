<?php

namespace App\Controller;

use App\Entity\Conge;
use App\Entity\Hollidays;
use App\Entity\UserProfile;
use App\Form\CongeFormType;
use App\Form\HollidaysFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class DayoffController extends  AbstractController
{
    #[Route('/dayofflist', name: 'dayofflist')]

    public function dayofflistAction(ManagerRegistry $doctrine ) : Response
    {
        // LIST OF ALL DAYS DISPLAY FOR ALL USERS
        $daysoff = $doctrine->getRepository(Hollidays::class);
        $listdays=$daysoff->findAll();
        return $this->render('dayoff/dayofflist.html.twig',array('daysoff' => $listdays));
    }

    #[Route('/ajouterjourferie', name: 'ajouterjourferie')]
    public function ajouterjourferieAction(ManagerRegistry $doctrine ,Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        // ADD NEW DAY OF TO THE LIST
        // ONLY ADMIN RH CAN ADD A DAYS
        $day = new Hollidays() ;
        $form = $this->createForm(HollidaysFormType::class, $day);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $day->setDay($form->get('day')->getData());
            $day->setDiscription($form->get('discription')->getData());
            $entityManager->persist($day);
            $entityManager->flush();
            return $this->redirectToRoute('dayofflist');
        }
        return $this->render('dayoff/adddayoff.html.twig',['registrationForm' => $form->createView(),]);
    }

    #[Route('/supprimedayoff/{id}', name: 'supprimedayoff')]
    public function supprimeAction(Conge $conge = null , ManagerRegistry $doctrine, $id):RedirectResponse
    {
        // DELETE  DAY OF FROM THE LIST
        // ONLY ADMIN RH CAN DELETE A DAYS
        $jour= $doctrine->getRepository(Hollidays::class)->findOneBy(array('id' => $id));
        if ($jour)
        {
            $manager= $doctrine ->getManager();
            $manager->remove($jour);
            $manager->flush();
            return $this->redirectToRoute('dayofflist');
        }
        return $this->redirectToRoute('dayofflist');
    }




}