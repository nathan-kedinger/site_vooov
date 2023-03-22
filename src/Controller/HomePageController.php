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
    /**
     * @param AudioRecordsClass $records
     * @param Request $request
     * @return Response
     */
    #[Route('/', name: 'home_page')]
    public function index(AudioRecordsClass $records, Request $request): Response
    {
        $recordForm = new AudioRecords;
        $researchForm = $this->createForm(ResearchRecordType::class, $recordForm);
        $researchForm->handleRequest($request);

        // live search ( not working)
        $formBuilder = $researchForm->getConfig()->getFormFactory()->createBuilder();
        $formBuilder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($records) {

            $data = $event->getData();
            $query = $data['title']; // Récupérer le terme de recherche
            $filteredRecords = $records->selectedAudioRecordsList($query); // Effectuer la recherche

            // Modifier les données du formulaire pour inclure les résultats de la recherche
            $data['filteredRecords'] = $filteredRecords;
            $event->setData($data);
        });

        // Search barre
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
}
