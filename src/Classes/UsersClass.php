<?php
namespace App\Classes;

use App\Entity\AudioRecords;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
class UsersClass{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer){
        $this->em = $em;
        $this->serializer = $serializer;
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
    public function findOneUserById(int $id): ?Users
    {
        $connection = $this->em->getConnection();
        $sql = 'CALL get_users_by_id(:user_id)';
        $stmt = $connection->prepare($sql);
        $stmt->bindValue('user_id', $id);
        $stmt->executeStatement();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {

            // Convert result in JSON
            $jsonResult = json_encode($result);

            //  Using serializer to convert JSON in Users Object
            $user = $this->serializer->deserialize($jsonResult, Users::class, 'json');

            // Manually creating Entity instance
            /*$user = new Users();
            $user->setId($result['id']);
            $user->setEmail($result['email']);
            $user->setroles($result['roles']);
            $user->setPassword($result['password']);
            $user->setIsVerified($result['is_verified']);
            $user->setUuid($result['uuid']);
            $user->setPseudo($result['pseudo']);
            $user->setName($result['name']);
            $user->setFirstname($result['firstname']);
            $user->setBirthday($result['birthday']);
            $user->setPhone($result['phone']);
            $user->setDescription($result['description']);
            $user->setNumberOfFollowers($result['number_of_followers']);
            $user->setNumberOfMoons($result['number_of_moons']);
            $user->setNumberOfFriends($result['number_of_friends']);
            $user->setUrlProfilePicture($result['url_profile_picture']);
            $user->setSignIn($result['sign_in']);
            $user->setLastConnection($result['last_connection']);*/


            return $user;
        }
        return null;

        //Basic Way
        //return $this->em->getRepository(Users::class)->findById($id);
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