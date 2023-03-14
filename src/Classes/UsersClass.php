<?php
namespace App\Classes;

use App\Entity\AudioRecords;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\Request;

class UsersClass{
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    public function UsersList(){
        $users = $this->em->getRepository(Users::class)->findAll();

        return $users;
    }

}