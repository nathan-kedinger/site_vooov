<?php
namespace App\Classes;

use App\Entity\AudioRecords;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\Request;

class UsersClass{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    public function UsersList(){
        return $this->em->getRepository(Users::class)->findAll();
    }

    public function findOneUserByPseudo($pseudo){
        return $this->em->getRepository(Users::class)->findByPseudo($pseudo);
    }

    public function findOneUserById($id){
        return $this->em->getRepository(Users::class)->findById($id);
    }
}