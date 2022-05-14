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
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class PortfolioController extends AbstractController
{
    #[Route('/', name: 'app_portfolio')]
    public function index(ProjectsRepository $projectsRepository, SkillsRepository $skillsRepository, PresentationRepository $presentationRepository, EntityManagerInterface $em, Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                $contact->setSendingDate(new \DateTime());
                $em->persist($contact);
                $em->flush();
                $this->addFlash('success', 'Votre message a bien été envoyé, je vais vous recontacter très rapidement');

                $email = (new Email())
                ->from('Kaliom.Geefker@gmail.com')
                ->to('L.P.Kaffin@gmail.com')
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Time for Symfony Mailer!')
                ->text('Sending emails is fun again!')
                ->html('<p>See Twig integration for better HTML integration!</p>');
                $mailer->send($email);
            }

        return $this->render('portfolio/index.html.twig', [
            'projects' => $projectsRepository->findProjects(true),
            'skills' => $skillsRepository->findAll(),
            'presentation' => $presentationRepository->findOneById(1),
            'form' => $form->createView(),
        ]);
    }
}
