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
        return $this->render('conge/historique.html.twig',array('conges' => $listconge));
    }


    #[Route('/demandeconge', name: 'demandeconge')]
    public function demandecongeAction(ManagerRegistry $doctrine ,Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $repository = $doctrine->getRepository(Conge::class);
        $conge = new Conge() ;
        $form = $this->createForm(CongeFormType::class, $conge);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $startday=$form->get('start_day')->getData() ;
            $endday= $form->get('end_day')->getData() ;
            /* calculer la deffrence enter les deux date */
            $conge->setStartDay($form->get('start_day')->getData());
            $conge->setEndDay($form->get('end_day')->getData());
            $conge->setTypeConge($form->get('type_conge')->getData());
            $conge->setStatuts("en attente");
            $conge->setDiscription($form->get('discription')->getData());
            $conge->setNombredujour(3);
            $entityManager->persist($conge);
            $entityManager->flush();
            return $this->redirectToRoute('congelist');
        }
        return $this->render('conge/demandeconge.html.twig',['registrationForm' => $form->createView(),]);
    }
    #[Route('/supprime/{id}', name: 'supprime')]
    public function supprimeAction(ManagerRegistry $doctrine ,$id)
    {
        $repository = $doctrine->getRepository(Conge::class);
        $conge=$repository->findOneBy(array('id' => $id));
        $repository->remove($conge);
        $repository->flush();
        return $this->redirectToRoute('congelist');
    }
    #[Route('/accepter/{id}/{nbj}', name: 'accepter')]
    public function accepterAction(ManagerRegistry $doctrine ,$id , $nbj)
    {
        // recupure  l'employer qui faire la demande
        $repository = $doctrine->getRepository(Conge::class);
        $conge=$repository->findOneBy(array('id' => $id));
        echo ($nbj) ;
        // die();
        if ($conge) {
            $type = $conge->getType();
            if ($type == 'maladie') {
                //  la soustraction depuis les jours maladie
            }
            else
            {
                //  la soustraction depuis les jours annuelle
            }
            $conge->setStatuts("accepter");
            $repository->persist($conge);
            $repository->flush();
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


