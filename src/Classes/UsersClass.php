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

    /**
     * @return Users[]
     */
    public function UsersList(){
        return $this->em->getRepository(Users::class)->findAll();
    }

    /**
     * @param $pseudo
     * @return int
     */
    public function findOneUserByPseudo($pseudo){
        return $this->em->getRepository(Users::class)->findByPseudo($pseudo);
    }

    /**
     * @param $id
     * @return int
     */
    public function findOneUserById($id){
        return $this->em->getRepository(Users::class)->findById($id);
    }

    /**
     * @return Users[]
     */
    public function selectedUsersList($pseudo): array{
        return $this->em->getRepository(Users::class)->findGroupByPseudo($pseudo);
    }
}