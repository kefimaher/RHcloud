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
        session_start();
        $value=$_SESSION["user"] ;
        echo $_SESSION["user"];
        echo ('<br>');
        echo $value ;
        die();
        $repository = $doctrine->getRepository(Conge::class);
        $conge = new Conge() ;
        $form = $this->createForm(CongeFormType::class, $conge);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $cretification=$form->get('cretification')->getData() ;
            if ($cretification==NULL)
            {
                $newfile = "ajouter voter certificate stp " ;
            }else {
                $photo = 'C:\Users\Administrator\Desktop\\'.$cretification;
                $newfile = 'C:\xampp\htdocs\RHcloud\public\photo profile\\'.$cretification;
            }
            copy($photo, $newfile);
            $startday=$form->get('start_day')->getData() ;
            $endday= $form->get('end_day')->getData() ;
            /* calculer la deffrence enter les deux date */
            $conge->setStartDay($form->get('start_day')->getData());
            $conge->setEndDay($form->get('end_day')->getData());
            $conge->setTypeConge($form->get('type_conge')->getData());
            $conge->setStatuts("en attente");
            $conge->setDiscription($form->get('discription')->getData());
            $conge->setNombredujour(3);
            $conge->setCretification($newfile);
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
<<<<<<< HEAD

    #[Route('/accepter/{id}/{nbj}', name: 'accepter')]
    public function accepterAction(ManagerRegistry $doctrine ,$id , $nbj)
=======
    #[Route('/accepter/{id}', name: 'accepter')]
    public function accepterAction(Conge $conge = null , ManagerRegistry $doctrine, $id):RedirectResponse
>>>>>>> 6efd7b66e3529461f22a24028b97b859add7e6cd
    {
        $conge = $doctrine->getRepository(Conge::class)->findOneBy(array('id' => $id));
        if ($conge)
        {
            $conge->setStatuts("accepter");
            // recupure le preson qui a conncter
            $manager= $doctrine ->getManager();
            $manager->persiste($conge);
            $manager->flush();
            return $this->redirectToRoute('congelist');
        }
        return $this->redirectToRoute('congelist');
    }
    #[Route('/refuse/{id}', name: 'refuse')]
    public function refuseAction(Conge $conge = null , ManagerRegistry $doctrine, $id):RedirectResponse
    {
        $conge = $doctrine->getRepository(Conge::class)->findOneBy(array('id' => $id));
        if ($conge)
        {
            $conge->setStatuts("refuse");
            $manager= $doctrine ->getManager();
            $manager->persiste($conge);
            $manager->flush();
            return $this->redirectToRoute('congelist');
        }
        return $this->redirectToRoute('congelist');
    }
}


