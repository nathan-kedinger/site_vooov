<?php

namespace App\Controller;

use App\Classes\AudioRecordsClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'home_page')]
    public function index(AudioRecordsClass $records): Response 
    {
        return $this->render('home_page/home_page.html.twig',[
            'records' => $records->audioRecordsList()
        ]);
    }
}
