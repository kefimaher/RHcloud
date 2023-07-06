<?php
namespace App\Controller;
use App\Entity\Conge;
use App\Entity\UserProfile;
use App\Form\CongeFormType;
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
        // LIST OF ALL CONGE DISPLAY TO THE ADMIN FOR ACCEPTING OR REFUSING REQUEST
        $conge = $doctrine->getRepository(Conge::class);
        $listconge=$conge->findAll();
        return $this->render('conge/congelist.html.twig',array('conges' => $listconge));
    }
    #[Route('/historique', name: 'historique')]
    public function historiqueAction(ManagerRegistry $doctrine ) : Response
    {
        // LIST OF ALL CONGE WITH ACCEPTING OR REFUSING SITUATION
        // ONLY ADMIN RH CAN SEE ALL THE REQUEST
        // USER CAN WTACH ONY HIS REQUEST
        $conge = $doctrine->getRepository(Conge::class);
        $userrole = $this->getUser()->getRoles();
        $Employernumber = $this->getUser()->getEmployernumber();
        // si utlisateur est admin il doit voire tous
        // recupure les list des conge statut accpeter ou refuse
        $role = $userrole[0];
        if ($role == "ROLE_ADMIN") {
            $listconge = $conge->findAll();
            return $this->render('conge/historiqueconge.html.twig', array('conges' => $listconge));
        }elseif ($role == "ROLE_USER")
        {
            $userprofile = $doctrine->getRepository(UserProfile::class)->findOneBy(array('employer_number' => $Employernumber));
            $userconges = $doctrine->getRepository(Conge::class)->findBy(array('user_profile' => $userprofile));
            return $this->render('conge/historiqueconge.html.twig', array('conges' => $userconges));
        }
        return $this->redirectToRoute('congelist');
    }
    #[Route('/demandeconge', name: 'demandeconge')]
    public function demandecongeAction(ManagerRegistry $doctrine ,Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        // SEN A REQUEST FOR LEAVE
        // ALL ADMINS RH AND USERS CAN SEND A REQUEST
        $iduser = $this->getUser()->getId();
        $userrole = $this->getUser()->getRoles();
        $role = $userrole[0];
        $userprofile = $doctrine->getRepository(UserProfile::class)->findOneBy(array('id' => $iduser));
        $repository = $doctrine->getRepository(Conge::class);
        $conge = new Conge() ;
        $form = $this->createForm(CongeFormType::class, $conge);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $datedebut=$form->get('start_day')->getData() ;
            $datefin= $form->get('end_day')->getData() ;
           //calculer la différence entre deux date
            $date3 = strtotime($datedebut);
            $date4 = strtotime($datefin);
            $nbJoursTimestamp = $date4 - $date3;
            $nbJours = round($nbJoursTimestamp / 86400) + 1;
            $conge->setStartDay($form->get('start_day')->getData());
            $conge->setEndDay($form->get('end_day')->getData());
            $conge->setTypeConge($form->get('type_conge')->getData());
            $conge->setStatuts("en attente");
            $conge->setDiscription($form->get('discription')->getData());
            $cretification = $form->get('cretification')->getData();
            if ($cretification==NULL)
            {
                $cretification='CERTIF.jpg';
            }else {
            // TAKE COPY OF YOUR CRETIFICATE AND PUT IT ON PROJECT FOLDERS
                $photo = 'C:\Users\Administrator\Desktop\\'.$cretification;
                $newfile = 'C:\xampp\htdocs\RHcloud\public\les certificat\\'.$cretification;
                copy($photo, $newfile);
            }
            $conge->setCretification($cretification);
            $conge->setNombredujour($nbJours);
            $conge->setUserProfile($userprofile);
            $entityManager->persist($conge);
            $entityManager->flush();
            if ($role == "ROLE_ADMIN"){
                return $this->redirectToRoute('congelist');
            }
            return $this->redirectToRoute('historique');
        }
        return $this->render('conge/demandeconge.html.twig',['registrationForm' => $form->createView(),]);
    }
    #[Route('/supprime/{id}', name: 'supprime')]
    public function supprimeAction(Conge $conge = null , ManagerRegistry $doctrine, $id):RedirectResponse
    {
        // UPLOAD USER DATA
        $nom = $this->getUser()->getNom() ;
        $prenom=$this->getUser()->getPrenom() ;
        $email =$this->getUser()->getEmail() ;
        echo ('le nom est  :'.$nom) ;
        echo ('<br>') ;
        echo ('le prenom est  :'.$prenom) ;
        echo ('<br>') ;
        echo ('email est :'.$email) ;
        echo ('<br>') ;
        // DELET A REQUEST OF CONGE
        // ONLY ADMIN RH CAN DELETE A REQUEST
        $conge = $doctrine->getRepository(Conge::class)->findOneBy(array('id' => $id));
        $datedebut = $conge ->getStartDay();
        $datefin = $conge->getEndDay();
        $status = $conge->getStatuts() ;
        $nombredejour = $conge -> getNombredujour() ;

        echo ('<br>') ;
        echo ('date de debut du conge est :'.$datedebut) ;
        echo ('<br>') ;
        echo ('date de fin de conge est :'.$datefin) ;
        echo ('<br>') ;
        echo ('conge statut :'.$status) ;
        echo ('<br>') ;
        echo ('nomrbre des jour :'.$nombredejour) ;
        echo ('<br>') ;

        if ($conge)
        {
           // SEND MAIL TO USER ==> YOU CONGE IS DELETED
          // CONNECTION TEST
       $connected = @fsockopen("www.google.com", 80);
       if ($connected) {
           $conx = true; // return 1
           echo('<br>');
           echo('connection resuuire ');

       }
            echo('connection echoue ');
            die() ;
          //     if ($conx == 1) {






            /*
                             $subject = "Nom de Société";
                             $message = "Bonjour :
              $nom $prenom a demander un congé de $nbJours jour du $datedebut au $datefin";
                             $mailer = $this->container->get('mailer');
                             $transport = \Swift_SmtpTransport::newInstance('smpt.gmail.com', 465, 'ssl')
                                 ->setUsername('mail')
                                 ->setPassword('password');
                             $mailer = \ Swift_Mailer::newInstance($transport);
                             $message = \ Swift_Message::newInstance('test')
                                 ->setSubject($subject)
                                 ->setFrom('mail')
                                 ->setTo($mailchef)
                                 ->setBody($message);
                             $this->get('mailer')->send($message);
                         }*/

            $manager= $doctrine ->getManager();
            $manager->remove($conge);
            $manager->flush();
            return $this->redirectToRoute('congelist');
        }
        return $this->redirectToRoute('congelist');
    }
    #[Route('/accepter/{id}', name: 'accepter')]
    public function accepterAction(Conge $conge = null , ManagerRegistry $doctrine, $id):RedirectResponse
    {
           // ACCEPTE A REQUEST OF CONGE
           // ONLY ADMIN RH CAN ACCEPTE A REQUEST
           $conge = $doctrine->getRepository(Conge::class)->findOneBy(array('id' => $id));
           $userid = $conge->getUserProfile()->getId();
           $userprofile = $doctrine->getRepository(UserProfile::class)->findOneBy(array('id' => $userid));
           $type=$conge->getTypeConge();
           $nbj= $conge->getNombredujour();
        if ($conge)
        {
            if ($type == 'Congé maladie')
            {
                 $day=$userprofile->getSickday() ;
                 if ($day>=$nbj)
                 {
                     $userprofile->setSickday($day-$nbj);
                     $userprofile->setDayout($nbj);
                     $conge->setStatuts("Accepter");
                 }else
                 {
                 return $this->redirectToRoute('congelist');
                 }
            }else
            {
                $day=$userprofile->getDayoffavailable() ;
                if ($day>=$nbj)
                {
                    $userprofile->setDayoffavailable($day-$nbj);
                    $userprofile->setDayout($nbj);
                    $conge->setStatuts("Accepter");
                }else
                {
                    return $this->redirectToRoute('congelist');
                }
            }
            $manager= $doctrine ->getManager();
            $manager->persist($conge);
            $manager->flush();
        }
        return $this->redirectToRoute('congelist');
    }
        #[Route('/refuse/{id}', name: 'refuse')]
    public function refuseAction(ManagerRegistry $doctrine ,$id)
    {
        // REFUSE A REQUEST OF CONGE
        // ONLY ADMIN RH CAN REFUSE A REQUEST
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


