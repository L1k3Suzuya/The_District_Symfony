<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MailService;

class ContactController extends AbstractController
{
    private $panier;

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager, MailService $ms): Response
    {
        $form = $this->createForm(ContactFormType::class);

        // $form = $this->createForm(ContactFormType::class, null, [
            // 'action' => $this->generateUrl('ma_route_spécifique'),
        // ]);>

        $form->handleRequest($request);

        if ($form->isSubmitted()&&$form->isValid()){

            $message = new Contact();
            $data = $form->getData();
            $message = $data;

            $entityManager->persist($message);
            $entityManager->flush();

            $myMail = 'admin@thedistrict.fr';
            $ms->sendMail($data->getEmail(),$myMail,$data->getObjet(),$data->getMessage());
            
            return $this->redirectToRoute('app_accueil');
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form,
        ]);
    }
}