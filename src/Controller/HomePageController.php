<?php

namespace App\Controller;

use App\Classes\AudioRecordsClass;
use App\Entity\AudioRecords;
use App\Form\ResearchRecordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function index(AudioRecordsClass $records, Request $request): Response 
    {
        $recordForm = new AudioRecords;
        $form = $this->createForm(ResearchRecordType::class, $recordForm);
        $form->handleRequest($request);
    
        $filteredRecords = [];

        if($form->isSubmitted() && $form->isValid()){
            $query = $form->get('title')->getData();
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
            'form' =>$form->createView()
        ]);
    }
}
