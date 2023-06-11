<?php
namespace App\Controller;
use App\Entity\Conge;
use App\Entity\UserProfile;
use App\Form\CongeFormType;
use App\Form\ProfileFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
class CongeController extends  AbstractController
{
    #[Route('/congelist', name: 'congelist')]

    public function congeslistAction(ManagerRegistry $doctrine ) : Response
    {
        // recupure les list des conge statut en attente
        $conge = $doctrine->getRepository(Conge::class);
        $listconge=$conge->findAll();
        return $this->render('conge/congelist.html.twig',array('conges' => $listconge));
    }

    #[Route('/historique', name: 'historique')]
    public function historiqueAction(ManagerRegistry $doctrine ) : Response
    {
        // recupure les list des conge statut accpeter ou refuse
        $conge = $doctrine->getRepository(Conge::class);
        $listconge=$conge->findAll();
        return $this->render('conge/historiqueconge.html.twig',array('conges' => $listconge));
    }


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
            $startday=$form->get('start_day')->getData() ;
            $endday= $form->get('end_day')->getData() ;
            $conge->setStartDay($form->get('start_day')->getData());
            $conge->setEndDay($form->get('end_day')->getData());
            $conge->setTypeConge($form->get('type_conge')->getData());
            $conge->setStatuts("en attente");
            $conge->setDiscription($form->get('discription')->getData());
            $conge->setNombredujour(3);
            $conge->setUserProfile($userprofile);
            $entityManager->persist($conge);
            $entityManager->flush();
            return $this->redirectToRoute('congelist');
        }
        return $this->render('conge/demandeconge.html.twig',['registrationForm' => $form->createView(),]);
    }



    #[Route('/supprime/{id}', name: 'supprime')]
    public function supprimeAction(Conge $conge = null , ManagerRegistry $doctrine, $id):RedirectResponse
    {
        $conge = $doctrine->getRepository(Conge::class)->findOneBy(array('id' => $id));
        if ($conge)
        {
            $manager= $doctrine ->getManager();
            $manager->remove($conge);
            $manager->flush();
            return $this->redirectToRoute('congelist');
        }
        return $this->redirectToRoute('congelist');
    }
    #[Route('/accepter/{id}', name: 'accepter')]
    public function accepterAction(Conge $conge = null , ManagerRegistry $doctrine, $id):RedirectResponse
    {
           $conge = $doctrine->getRepository(Conge::class)->findOneBy(array('id' => $id));
           $userid = $conge->getUserProfile()->getId();
           $userprofile = $doctrine->getRepository(UserProfile::class)->findOneBy(array('id' => $userid));
           $type=$conge->getTypeConge();
           $nbj= $conge->getNombredujour();
        if ($conge)
        {
            if ($type == 'Congé maladie')
            {
                // réduction depuit la solde de maladie
                 $day=$userprofile->getSickday() ;
                 if ($day>=$nbj)
                 {
                     $userprofile->setSickday($day-$nbj);
                     $userprofile->setDayout($nbj);
                     $conge->setStatuts("Accepter");
                 }else
                 {
                 return $this->redirectToRoute('congelist');
                 }
            }else
            {
                // réduction depuit la solde de annuelle
                $day=$userprofile->getDayoffavailable() ;
                if ($day>=$nbj)
                {
                    $userprofile->setDayoffavailable($day-$nbj);
                    $userprofile->setDayout($nbj);
                    $conge->setStatuts("Accepter");
                }else
                {
                    return $this->redirectToRoute('congelist');
                }
            }
            $manager= $doctrine ->getManager();
            $manager->persist($conge);
            $manager->flush();
        }
        return $this->redirectToRoute('congelist');
    }

        #[Route('/refuse/{id}', name: 'refuse')]
    public function refuseAction(ManagerRegistry $doctrine ,$id)
    {
        $repository = $doctrine->getRepository(Conge::class);
        $conge=$repository->findOneBy(array('id' => $id));
        if ($conge)
        {
            $conge->setStatuts("refuser");
            $repository->persist($conge);
            $repository->flush();
        }
        return $this->redirectToRoute('congelist');
    }



}


