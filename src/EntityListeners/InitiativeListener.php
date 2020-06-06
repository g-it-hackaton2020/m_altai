<?php


namespace App\EntityListeners;


use App\Entity\DocStad;
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
        $d = new \DateTime();
        $pre = $d->format("Y-m");

        $initiative->setName("Инициатива $pre/".str_pad((string)$num,8,'0',STR_PAD_LEFT));

        $stad =  $em->getRepository(DocStad::class)->find("draft");
        $initiative->setStad($stad);

    }

}