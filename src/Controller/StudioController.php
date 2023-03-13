<?php

namespace App\Controller;

use App\Entity\AudioRecords;
use App\Entity\Users;
use App\Form\AudioRecordType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Nonstandard\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class StudioController extends AbstractController
{
    #[Route('studio', name: 'app_studio')]
    public function index(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {   
        if ($security->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $security->getUser();
        } else {
            $user = null;
        }
        $record = new AudioRecords();
        $form = $this->createForm(AudioRecordType::class, $record);
        $form->handlerequest($request);
        $uuid = Uuid::uuid4();
        $uuid_string = $uuid->toString();
        $actualeDate = new DateTime('now');
        $actualeDate_string = $actualeDate->format('d/m/y');

        if ($form->isSubmitted() && $form->isValid()) {

            $record->setUuid($uuid_string);
            $record->setArtistId($user);
            $record->setLength(0);
            $record->setNumberOfPlays(0);
            $record->setNumberOfMoons(0);
            $record->setCreatedAt($actualeDate_string);
            $record->setUpdatedAt($actualeDate_string);

            $entityManager->persist($record);
            $entityManager->flush();

            $this->addFlash('notice', 'L\'enregistrement a bien été créé.');

        }

        return $this->render('studio/index.html.twig', [
            'audioRecordForm' => $form->createView(),

        ]);
    }
}
