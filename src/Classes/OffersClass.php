<?php
namespace App\Classes;

use App\Entity\Offers;
use Doctrine\ORM\EntityManagerInterface;

class OffersClass{
    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    public function offersList(){
        $offers = $this->em->getRepository(Offers::class)->findAll();

        return $offers;
    }
}