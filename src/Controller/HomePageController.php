<?php

namespace App\Controller;

use App\Classes\AudioRecordsClass;
use App\Classes\ConversationsClass;
use App\Classes\UsersClass;
use App\Entity\AudioRecords;
use App\Entity\Conversations;
use App\Entity\Messages;
use App\Form\MessageType;
use App\Form\ResearchRecordType;
use Ramsey\Uuid\Nonstandard\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function index(AudioRecordsClass $records, ConversationsClass $conversations, Request $request, Security $security): Response
    {
        $recordForm = new AudioRecords;
        $researchForm = $this->createForm(ResearchRecordType::class, $recordForm);
        $researchForm->handleRequest($request);

        // Écouter l'événement PRE_SUBMIT du formulaire
        $formBuilder = $researchForm->getConfig()->getFormFactory()->createBuilder();
        $formBuilder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($records) {

            $data = $event->getData();
            $query = $data['title']; // Récupérer le terme de recherche
            $filteredRecords = $records->selectedAudioRecordsList($query); // Effectuer la recherche

            // Modifier les données du formulaire pour inclure les résultats de la recherche
            $data['filteredRecords'] = $filteredRecords;
            $event->setData($data);
        });

        if($researchForm->isSubmitted() && $researchForm->isValid()){
            $query = $researchForm->get('title')->getData();
            $filteredRecords = $records->selectedAudioRecordsList($query);

            // Ajouter ce code pour le débogage
            if(empty($filteredRecords)) {
                $this->addFlash('warning', 'Aucun enregistrement trouvé pour votre recherche.');
            }
        } else {
            $filteredRecords = $records->audioRecordsList();
        }

        return $this->render('home_page/home_page.html.twig',[
            'records' => $filteredRecords,
            'form' =>$researchForm->createView(),

        ]);
    }
    #[Route('/message/{id}', name: 'home_page_message')]
    public function sendMessage($id, UsersClass $receiverUser, AudioRecordsClass $records, ConversationsClass $conversations, Request $request, Security $security): Response
    {
        $recordForm = new AudioRecords;
        $researchForm = $this->createForm(ResearchRecordType::class, $recordForm);
        $researchForm->handleRequest($request);

        // Écouter l'événement PRE_SUBMIT du formulaire
        $formBuilder = $researchForm->getConfig()->getFormFactory()->createBuilder();
        $formBuilder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($records) {

            $data = $event->getData();
            $query = $data['title']; // Récupérer le terme de recherche
            $filteredRecords = $records->selectedAudioRecordsList($query); // Effectuer la recherche

            // Modifier les données du formulaire pour inclure les résultats de la recherche
            $data['filteredRecords'] = $filteredRecords;
            $event->setData($data);
        });

        if($researchForm->isSubmitted() && $researchForm->isValid()){
            $query = $researchForm->get('title')->getData();
            $filteredRecords = $records->selectedAudioRecordsList($query);

            // Ajouter ce code pour le débogage
            if(empty($filteredRecords)) {
                $this->addFlash('warning', 'Aucun enregistrement trouvé pour votre recherche.');
            }
        } else {
            $filteredRecords = $records->audioRecordsList();
        }


        $message = new Messages();
        $sendingMessage = $this->createForm(MessageType::class, $message);
        $sendingMessage->handleRequest($request);
        $uuid = Uuid::uuid4();
        $uuid_string = $uuid->toString();
        $actualeDate = new \DateTime('now');
        $actualeDate_string = $actualeDate->format('d/m/y');
        $receiver = $receiverUser->findOneUserById($id);

        if ($sendingMessage->isSubmitted() && $sendingMessage->isValid()) {
            if ($security->isGranted('IS_AUTHENTICATED_FULLY')) {
                $user = $security->getUser();
                $targetedConversation = $conversations->findOneConversation($user, $receiver);
                if($targetedConversation != null){
                    $message->setUuid($uuid_string);
                    $message->setConversationUuid($targetedConversation->getUuid());
                    $message->setSender($user);
                    $message->setReceiver($receiver);
                    $message->setSeen(false);
                    $message->setSendAt($actualeDate_string);
                } else {
                    $conversations->createConversations($user, $receiver);

                    $message->setUuid($uuid_string);
                    $message->setConversationUuid($targetedConversation->getUuid());
                    $message->setSender($user);
                    $message->setReceiver($receiver);
                    $message->setSeen(false);
                    $message->setSendAt($actualeDate_string);
                }
            } else {
                // Renvoyer un message proposant de se connecter
            }
        }
        return $this->render('home_page/home_page_with_message.html.twig',[
            'records' => $filteredRecords,
            'form' =>$researchForm->createView(),
            'sendingMessage' => $sendingMessage->createView()
        ]);
    }
}
