<?php

namespace App\Controller;

use App\Entity\Conge;
use App\Entity\Hollidays;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DayoffController extends  AbstractController
{
    #[Route('/dayofflist', name: 'dayofflist')]

    public function dayofflistAction(ManagerRegistry $doctrine ) : Response
    {

        $daysoff = $doctrine->getRepository(Hollidays::class);
        $listdays=$daysoff->findAll();
        return $this->render('dayoff/dayofflist.html.twig',array('dayoff' => $listdays));
    }




}