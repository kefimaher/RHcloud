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
    public function profile(ManagerRegistry $doctrine , $id ,Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {

        $repository = $doctrine->getRepository(Conge::class);
        $conge = $repository ->findOneBy(array('id' => $id));
        if ($conge != null)
        {
            $repository->remove($conge);
            $repository->flush();
            return $this->redirectToRoute('congelist');
        }
        return $this->redirectToRoute('congelist');
    }
}


