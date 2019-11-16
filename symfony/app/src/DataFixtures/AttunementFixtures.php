<?php

namespace App\DataFixtures;

use App\Entity\Attunement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AttunementFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $attunement = new Attunement();
        $attunement->setName('Molten Core');

        $attunement1 = new Attunement();
        $attunement1->setName('Onyxia');

        $attunement2 = new Attunement();
        $attunement2->setName('Blackwing Lair');
        
        $manager->persist($attunement);
        $manager->persist($attunement1);
        $manager->persist($attunement2);

        $manager->flush();
    }
}
