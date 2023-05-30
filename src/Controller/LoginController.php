<?php
namespace App\Controller;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @property $_em
 */
class LoginController extends  AbstractController
{
    #[Route('/dashbroad', name: 'dashbroad')]
    public function dashbroadAction(ManagerRegistry $doctrine ) : Response
    {
        $User = $doctrine->getRepository(User::class);
        $listuser = $User->findAll();
        return $this->render('dashbroad/dashbroad.html.twig', array('users' => $listuser));
        }
    }
