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
     * @param string $pseudo
     * @return Users
     */
    public function findOneUserByPseudo(string $pseudo): Users
    {
        return $this->em->getRepository(Users::class)->findByPseudo($pseudo);
    }

    /**
     * @param int $id
     * @return Users
     */
    public function findOneUserById(int $id): Users
    {
        return $this->em->getRepository(Users::class)->findById($id);
    }

    /**
     * @param string $pseudo
     * @return array
     */
    public function selectedUsersList(string $pseudo): array
    {
        return $this->em->getRepository(Users::class)->findGroupByPseudo($pseudo);
    }
}