<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\SkillsRepository;
use App\Repository\ProjectsRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PresentationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//mail
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class PortfolioController extends AbstractController
{
    #[Route('/', name: 'app_portfolio')]
    public function index(MailerInterface $mailer, ProjectsRepository $projectsRepository, SkillsRepository $skillsRepository, PresentationRepository $presentationRepository, EntityManagerInterface $em, Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                $contact->setSendingDate(new \DateTime());
                $em->persist($contact);
                $em->flush();
                $this->addFlash('success', 'Votre message a bien été envoyé, je vais vous recontacter très rapidement');
                
                $fd = $form->getData();               
                
                $mailText='Message de ' .$fd->getName(). ' ('. $fd->getEmail() .")\r\n  
                ".$fd->getMessage();
                
              $email = (new Email())  
              ->from('sender@example.com')
              ->to('receiver@example.com')
              //->cc('cc@example.com')
              //->bcc('bcc@example.com')
              //->replyTo('fabien@example.com')
              //->priority(Email::PRIORITY_HIGH)
              ->subject($fd->getTopic() )
              ->text($mailText)
              ->html('<p>'. nl2br($mailText) .'</p>');

              try {
                $mailer->send($email);
              } catch (TransportExceptionInterface $e) {
              // some error prevented the email sending; display an
              // error message or try to resend the message
              $this->addFlash('error', 'erreur lors de l\'envoi du mail' . $e);
              }
            }

        return $this->render('portfolio/index.html.twig', [
            'projects' => $projectsRepository->findProjects(true),
            'skills' => $skillsRepository->findAll(),
            'presentation' => $presentationRepository->findOneById(1),
            'form' => $form->createView(),
        ]);
    }
}
