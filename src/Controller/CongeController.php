<?php
namespace App\Controller;
use App\Entity\Conge;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
}


