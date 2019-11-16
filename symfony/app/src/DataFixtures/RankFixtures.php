<?php

namespace App\DataFixtures;

use App\Entity\Rank;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RankFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $rank = new Rank();
        $rank->setName('Alt');

        $rank1 = new Rank();
        $rank1->setName('Social');

        $rank2 = new Rank();
        $rank2->setName('Raider');
        
        $rank3 = new Rank();
        $rank3->setName('Officer');

        $rank4 = new Rank();
        $rank4->setName('Trial');

        $rank5 = new Rank();
        $rank5->setName('Class leader');

        $rank6 = new Rank();
        $rank6->setName('Officer alt');

        $rank7 = new Rank();
        $rank7->setName('Guild master');

        $manager->persist($rank);
        $manager->persist($rank1);
        $manager->persist($rank2);
        $manager->persist($rank3);
        $manager->persist($rank4);
        $manager->persist($rank5);
        $manager->persist($rank6);
        $manager->persist($rank7);

        $manager->flush();
    }
}
