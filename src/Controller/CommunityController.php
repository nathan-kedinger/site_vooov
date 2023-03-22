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
        $search = new Users();
        $form = $this->createForm(ResearchUserType::class, $search);
        $form->handleRequest($request);

        $filteredUsers = $users->UsersList();
        // Search barre
        if($form->isSubmitted() && $form->isValid()){
            $query = $form->get('pseudo')->getData();

            $filteredUsers = $users->selectedUsersList($query);

            // Ajouter ce code pour le débogage
            if(empty($filteredUsers)) {
                $this->addFlash('warning', 'Aucun enregistrement trouvé pour votre recherche.');
            }
        }


        return $this->render('community/index.html.twig', [
            'users' => $filteredUsers,
            'form' => $form->createView()
        ]);
    }
}
