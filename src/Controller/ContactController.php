<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\MailerContact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact_index')]
    public function index(Request $request, EntityManagerInterface $entityManager, MailerContact $mailerContact): Response
    {

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           $entityManager->persist($contact);
           $entityManager->flush();

           $mailerContact->sendEmail(from: $contact->getEmail(), to: $this->getParameter('mailer_from'), subject: 'Vous avez reçu un mail', html: ($this->renderView('contact/EmailContact.html.twig',[
               'contact' => $contact
           ])));
           $this->addFlash('success', 'Le mail a été envoyé. Nous vous répondrons le plus rapidement possible');
           return  $this->redirectToRoute('app_homepage_index');
        }

        return $this->render('contact/contact_index.html.twig', [
            'form'=> $form
        ]);
    }
}
