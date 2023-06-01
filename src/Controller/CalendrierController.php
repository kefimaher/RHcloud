<?php

namespace App\Controller;

use App\Entity\Conge;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendrierController  extends  AbstractController
{
    #[Route('/calendrier', name: 'calendrier')]
    public function calendrierAction(ManagerRegistry $doctrine ) : Response
    {
        return $this->render('calendrier/calendrier.html.twig');
    }
}