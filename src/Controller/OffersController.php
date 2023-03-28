<?php

namespace App\Controller;

use App\Classes\ConversationsClass;
use App\Classes\OffersClass;
use App\Entity\Offers;
use App\Entity\Users;
use App\Form\OfferType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffersController extends AbstractController
{
    #[Route('/offres', name: 'app_offers')]
    public function index(OffersClass $offers, EntityManagerInterface $em, Security $security, ConversationsClass $conversations): Response
    {
        // Conversations logic implementation
        $currentUser = $security->getUser();
        if (!$currentUser instanceof Users) {
            $currentUserConversations = "";
        } else {
            $currentUserConversations = $conversations->findCurrentUserConversations($currentUser->getId(), $em);
        }
        return $this->render('offers/index.html.twig', [
            'offers' => $offers->offersList(),
            'conversations' => $currentUserConversations,

        ]);
    }

    #[Route('/nouvelle-offre', name: 'app_new_offer')]
    public function newOffer(Request $request, EntityManagerInterface $em, Security $security, ConversationsClass $conversations): Response
    {
        // Conversations logic implementation
        $currentUser = $security->getUser();
        if (!$currentUser instanceof Users) {
            $currentUserConversations = "";
        } else {
            $currentUserConversations = $conversations->findCurrentUserConversations($currentUser->getId(), $em);
        }

        if ($security->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $security->getUser();
        } else {
            $user = null;
        }
        $offer = new Offers();
        $form = $this->createForm(OfferType::class, $offer);
        $form->handleRequest($request);
        $uuid = Uuid::uuid4();
        $uuid_string = $uuid->toString();
        $actualeDate = new DateTime('now');
        $actualeDate_string = $actualeDate->format('d/m/y');

        if ($form->isSubmitted() && $form->isValid()) {
            $offer->setUuid($uuid_string);
            $offer->setAccomplished(false);
            $offer->setCreatedAt($actualeDate_string);
            $offer->setUserId($user);

            
            $em->persist($offer);
            $em->flush();
        }

        return $this->render('offers/new_offer.html.twig', [
            'offersForm' => $form->createView(),
            'conversations' => $currentUserConversations,

        ]);
    }
}
