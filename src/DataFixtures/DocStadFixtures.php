<?php

namespace App\DataFixtures;

use App\Entity\DocStad;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DocStadFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $draft = new DocStad("draft");
        $draft->setName("Черновик");

        $sended = new DocStad("sended");
        $sended->setName("Отправлена");

        $review = new DocStad("review");
        $review->setName("На рассмотрении");

        $accept = new DocStad("accept");
        $accept->setName("Принята к исполнению");

        $reject = new DocStad("reject");
        $reject->setName("Отклонена");

        $compliat = new DocStad("compliat");
        $compliat->setName("Завершена");

        $manager->persist($draft);
        $manager->persist($sended);
        $manager->persist($review);
        $manager->persist($accept);
        $manager->persist($reject);
        $manager->persist($compliat);

        $manager->flush();
    }
}
