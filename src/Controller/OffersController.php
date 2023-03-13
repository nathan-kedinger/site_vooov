<?php

namespace App\Controller;

use App\Classes\OffersClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffersController extends AbstractController
{
    #[Route('/offres', name: 'app_offers')]
    public function index(OffersClass $offers): Response
    {
        return $this->render('offers/index.html.twig', [
            'offers' => $offers->offersList(),
        ]);
    }
}
