<?php

namespace App\Controller;

use App\Classes\SearchUser;
use App\Classes\UsersClass;
use App\Entity\Users;
use App\Form\ResearchUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommunityController extends AbstractController
{

    #[Route('/communaute', name: 'app_community')]
    public function index(UsersClass $users, Request $request): Response
    {
        $search = new SearchUser();
        $form = $this->createForm(ResearchUserType::class, $search);
        $form->handleRequest($request);


        // Search barre
        if($form->isSubmitted() && $form->isValid()){
            $query = $form->get('title')->getData();
            $filteredUsers = $users->selectedAudioRecordsList($query);

            // Ajouter ce code pour le débogage
            if(empty($filteredRecords)) {
                $this->addFlash('warning', 'Aucun enregistrement trouvé pour votre recherche.');
            }
        } else {
            $filteredRecords = $users->audioRecordsList();
        }


        return $this->render('community/index.html.twig', [
            'users' => $users->UsersList(),
            'form' => $form->createView()
        ]);
    }
}
