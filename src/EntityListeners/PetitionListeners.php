<?php


namespace App\EntityListeners;


use App\Entity\DocumentNum;
use App\Entity\Petition;
use Doctrine\ORM\Event\LifecycleEventArgs;

class PetitionListeners
{

    public function prePersist(Petition $petition, LifecycleEventArgs $event)
    {
        // some code
        $em = $event->getEntityManager();
        $doc_num = new DocumentNum();
        $em->persist($doc_num);
        $em->flush();
        $num = $doc_num->getId();

        $petition->setNum($num);
        $d = new \DateTime();
        $pre = $d->format("Y-m");

        $petition->setName("Обращение $pre/".str_pad((string)$num,8,'0',STR_PAD_LEFT));

    }

}