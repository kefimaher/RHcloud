<?php
namespace App\Controller;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
class RegistrationController extends AbstractController
{
    #[Route('/addemployee', name: 'addemployee')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        // ADD NEW EMPLOYEE
        // ONLY ADMIND RH CAN  ADD NEW EMPLOYEE
        $user = new User();
        $userprofile = new UserProfile() ;  // cree un user profile vide pour utlise pour complete la table user profile
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $avatar=$form->get('avatar')->getData() ;
            $image = $avatar ;
            if ($avatar==NULL)
            {
                $image='guest.png';
            }else {
               // copier votre image de  de bureau ver votre dossier
                $photo = 'C:\Users\Administrator\Desktop\\'.$avatar;
                $newfile = 'C:\xampp\htdocs\RHcloud\public\photo profile\\'.$avatar;
                copy($photo, $newfile);
            }
            $user->setRealpassword($form->get('plainPassword')->getData());
            $user->setFirstname($form->get('firstname')->getData());
            $user->setAvatar($image);
            $user->setLastname($form->get('lastname')->getData());
            $fonction=$form->get('fonction')->getData() ;
            if($fonction=="Employé RH"){
                $user->setRoles(array('ROLE_ADMIN'));
            }
            else{
                $user->setRoles(array('ROLE_USER'));
            }
            $user->setFonction($fonction);
            $user->setFonction($form->get('fonction')->getData());
            $user->setEmployernumber($form->get('employernumber')->getData());
            $user->setEmail($form->get('email')->getData());
            $user->setPassword($userPasswordHasher->hashPassword($user, $form->get('plainPassword')->getData()));
            $userprofile->setEmployerNumber($form->get('employernumber')->getData());
            $userprofile->setDayoffavailable(22);
            $userprofile->setSickday(5);
            $userprofile->setDayout(0);
            $user->setProfile($userprofile);
            $entityManager->persist($userprofile);
            $entityManager->flush();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('dashbroad');
        }
        return $this->render('employees/addemployee.html.twig', ['registrationForm' => $form->createView(),]);
    }
}
