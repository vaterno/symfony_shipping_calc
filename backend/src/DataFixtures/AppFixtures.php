<?php

namespace App\DataFixtures;

use App\Entity\Carrier;
use App\Services\Shipping\Carriers\PackgroupCarrier;
use App\Services\Shipping\Carriers\TransCompanyCarrier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $carrier1 = new Carrier();
        $carrier1
            ->setName(PackgroupCarrier::NAME)
            ->setSlug(PackgroupCarrier::SLUG)
            ->setIsActive(true);

        $carrier2 = new Carrier();
        $carrier2
            ->setName(TransCompanyCarrier::NAME)
            ->setSlug(TransCompanyCarrier::SLUG)
            ->setIsActive(true);

        $manager->persist($carrier1);
        $manager->persist($carrier2);

        $manager->flush();
    }
}
