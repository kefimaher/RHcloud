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
    public function dashbroadAction(ManagerRegistry $doctrine): Response
    {
            $userrole = $this->getUser()->getRoles();
            $role = $userrole[0];
                if ($role == "ROLE_ADMIN")
                {
                    $User = $doctrine->getRepository(User::class);
                    $listuser = $User->findAll();
                      return $this->render('dashbroad/dashbroad.html.twig', array('users' => $listuser));
                }
                else
                {
                    return $this->redirectToRoute('demandeconge');
                }
            return $this->redirectToRoute('app_logout');
    }
}

