<?php
namespace App\Classes;

use App\Entity\AudioRecords;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;

class AudioRecordsClass{
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    public function audioRecordsList(){
        $records = $this->em->getRepository(AudioRecords::class)->findAll();

        return $records;
    }

}