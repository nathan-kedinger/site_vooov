<?php

namespace App\Controller;

use App\Classes\AudioRecordsClass;
use App\Classes\ConversationsClass;
use App\Entity\AudioRecords;
use App\Entity\Users;
use App\Form\ResearchRecordType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @param AudioRecordsClass $records
     * @param Request $request
     * @param ConversationsClass $conversations
     * @param Security $security
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route('/', name: 'home_page')]
    public function index(AudioRecordsClass $records, Request $request, ConversationsClass $conversations, Security $security, EntityManagerInterface $em): Response
    {
        // Conversations logic implementation
        $currentUser = $security->getUser();
        if (!$currentUser instanceof Users) {
            $currentUserConversations = "";
        } else {
            $currentUserConversations = $conversations->findCurrentUserConversations($currentUser->getId(), $em);
        }

        $recordForm = new AudioRecords;
        $researchForm = $this->createForm(ResearchRecordType::class, $recordForm);
        $researchForm->handleRequest($request);

        // Search barre
        if($researchForm->isSubmitted() && $researchForm->isValid()){
            $query = $researchForm->get('title')->getData();
            $filteredRecords = $records->selectedAudioRecordsList($query);

            // To fix issues
            if(empty($filteredRecords)) {
                $this->addFlash('warning', 'Aucun enregistrement trouvé pour votre recherche.');
            }
        } else {
            $filteredRecords = $records->audioRecordsList();
        }

        return $this->render('home_page/home_page.html.twig',[
            'records' => $filteredRecords,
            'form' => $researchForm->createView(),
            'conversations' => $currentUserConversations,
        ]);
    }
}
