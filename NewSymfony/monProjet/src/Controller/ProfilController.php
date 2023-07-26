<?php


namespace App\Controller;

use App\Repository\UtilisateurRepository;
use App\Service\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    private $panier;
    private $utilisateurRepository;

    public function __construct(UtilisateurRepository $utilisateurRepository, PanierService $panier){
        $this->utilisateurRepository = $utilisateurRepository;
        $this->panier = $panier;
    }
    #[Route('/profil', name: 'app_profil')]
    public function index(): Response
    {
        $panier = $this->panier->getPanier();
        $qtt = $this->panier->getTotalQuantity();
        $identifiant = $this->getUser()->getUserIdentifier();
        if($identifiant){
            $info = $this->utilisateurRepository->findOneBy(["email" =>$identifiant]);
        }

        return $this->render('profil/index.html.twig', [
            'informations' => $info,
            'panier' => $panier,
            'total_qtt' => $qtt,
        ]);
    }
}

//TODO: MODIFIER REDIRECTION APRES INSCRIPTION OU CONNEXION VERS PAGE PROFIL