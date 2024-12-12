<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    //Deebut de la Route
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
                ->to('responsable@entreprise.com')// Exemple d'email simple
                ->subject('Nouvelle fiche contact')
                ->text(sprintf(
                    "Nom : %s\nPrénom : %s\nEmail : %s\nMessage : %s", // J'utilise ces placesholders pour les inserer dans la chaine  et j'utlise %s qui sera remplacer par les variables fournies dans l'ordre
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
    //Fin de la Route 


}
