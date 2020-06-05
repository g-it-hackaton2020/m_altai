<?php


namespace App\EntityListeners;


use App\Entity\DocumentNum;
use App\Entity\Initiative;
use Doctrine\ORM\Event\LifecycleEventArgs;

class InitiativeListener
{

    public function prePersist(Initiative $initiative, LifecycleEventArgs $event)
    {
        // some code
        $em = $event->getEntityManager();
        $doc_num = new DocumentNum();
        $em->persist($doc_num);
        $em->flush();
        $num = $doc_num->getId();

        $initiative->setNum($num);

        $initiative->setName("Инициатива ".str_pad((string)$num,8,'0',STR_PAD_LEFT));

    }

}