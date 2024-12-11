<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, \Symfony\Component\Mailer\MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // Envoi de l'email
            $email = (new \Symfony\Component\Mime\Email())
                ->from($data['email'])
                ->to('responsable@' . strtolower($data['departement']->getNom()) . '.com') // Exemple d'email
                ->subject('Nouvelle fiche contact')
                ->text(sprintf(
                    "Nom : %s\nPrénom : %s\nEmail : %s\nMessage : %s",
                    $data['nom'],
                    $data['prenom'],
                    $data['email'],
                    $data['message']
                ));

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a bien été envoyé !');
            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
