<?php
namespace App\Controller;
use App\Entity\Conge;
use App\Entity\Reception;
use App\Entity\UserProfile;
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
        // ONLY ADMIN CAN WATCH ALL REQUEST OF EMPLOEYR
        // USER WATCH ONLY HIS REQUEST
        $reception = $doctrine->getRepository(Reception::class);
        $listreception=$reception->findAll();
        return $this->render('demanderh/demanderhlist.html.twig',array('receptions' => $listreception));
    }
    #[Route('/demanderh', name: 'demanderh')]
    public function demandecongeAction(ManagerRegistry $doctrine ,Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {

        // ALL USER CAN SEND A REQUEST
        $iduser = $this->getUser()->getId();
        $userprofile = $doctrine->getRepository(UserProfile::class)->findOneBy(array('id' => $iduser));
        $demanderh = new Reception() ;
        $form = $this->createForm(ReceptionFormType::class, $demanderh);
        $form->handleRequest($request);
        if ($form->isSubmitted())
        {
            $demanderh->setDatequestion(date('Y-m-d')) ;
            $demanderh->setQuestion($form->get('question')->getData());
            $demanderh->setStatut("en attente");
            $demanderh->setUserProfile($userprofile);
            $entityManager->persist($demanderh);
            $entityManager->flush();
            return $this->redirectToRoute('demanderhlist');
        }
        return $this->render('demanderh/demanderh.html.twig',['registrationForm' => $form->createView(),]);
    }
    #[Route('/supprimerdemande/{id}', name: 'supprimerdemande')]
    public function supprimerdemandeAction(Reception $demande = null , ManagerRegistry $doctrine, $id): RedirectResponse
    {
        // ONLY ADMIN CAN DELETE THE REQUEST OF USERS
        $iduser = $this->getUser()->getId();
        $demande = $doctrine->getRepository(Reception::class)->findOneBy(array('id' => $id));
        if ($demande)
        {
            $manager= $doctrine ->getManager();
            $manager->remove($demande);
            $manager->flush();
        }
        return $this->redirectToRoute('demanderhlist');
    }
    #[Route('/accepterdemande/{id}', name: 'accepterdemande')]
    public function aaccepterdemandeAction(Reception $demande = null , ManagerRegistry $doctrine, $id): RedirectResponse
    {
        // ONLY ADMIN CAN ACCEPT  THE REQUEST OF USERS
        $iduser = $this->getUser()->getId();
        $demande = $doctrine->getRepository(Reception::class)->findOneBy(array('id' => $id));
        if ($demande)
        {
            $manager= $doctrine ->getManager();
            $demande->setStatut('accepter') ;
            $manager->persist($demande);
            $manager->flush();
        }
        return $this->redirectToRoute('demanderhlist');
    }
    #[Route('/refuserdemande/{id}', name: 'refuserdemande')]
    public function refuserdemandeAction(Reception $demande = null , ManagerRegistry $doctrine, $id): RedirectResponse
    {
        // ONLY ADMIN CAN REFUSE  THE REQUEST OF USERS
        $iduser = $this->getUser()->getId();
        $demande = $doctrine->getRepository(Reception::class)->findOneBy(array('id' => $id));
        if ($demande)
        {
            $manager= $doctrine ->getManager();
            $demande->setStatut('Refuse') ;
            $manager->persist($demande);
            $manager->flush();
        }
        return $this->redirectToRoute('demanderhlist');
    }
}