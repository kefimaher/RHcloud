<?php
namespace App\Controller;
use App\Entity\User;
use App\Service\MailerService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        // LOGIN
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }
    #[Route(path: '/password', name: 'password')]
    public function password(ManagerRegistry $doctrine): Response
    {   // PASSWORD RECUPURATION
        $mail=$_POST['email'] ;
        $user = $doctrine->getRepository(User::class)->findOneBy(array('email' => $mail));
     //   MailerService::class $mail ;
        if ($user)
        {
            $password = $user->getRealpassword() ;
        }
        return $this->redirectToRoute('app_login');
    }
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        // LOG OUT
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
