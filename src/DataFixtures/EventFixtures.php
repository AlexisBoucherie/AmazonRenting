<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Monolog\DateTimeImmutable;

class EventFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($x = 0; $x < 20; $x++) {
            $event = new Event();

            $startDate = $faker->DateTimeBetween('-15 days', '+15 day');
            $randNbOfDays = rand(1, 7);
            $endDate = $startDate->modify('+1 day');

            $startKm = $faker->numberBetween(0, 20000);
            $randDistance = $faker->numberBetween(30, 500);
            $returnKm = $startKm + $randDistance;
            $returnStatus = [$returnKm, 0];
            $carStatus = ['rented', 'maintenance'];
            $returnCondition = ['good', 'medium', 'poor', 'waiting for car return'];

//            $event->setUserId($faker->numberBetween(2, 21));
//            $event->setVehicleId($faker->numberBetween(1, 20));
            $event->setStartDate($startDate);
            $event->setEndDate($startDate->modify('+1 day'));
            $event->setReturnLocalisation($faker->city);
            $event->setStartCondition('good');
            $event->setReturnCondition($returnCondition[rand(0,3)]);
            $event->setLicenceNumber($faker->numberBetween(1000, 9999));
            $event->setStartKm($startKm);
            $event->setReturnKm($returnStatus[rand(0, 1)]);
            $event->setStatus($carStatus[rand(0, 1)]);
            $event->setCreatedAt(new DateTimeImmutable('now'));

            $manager->persist($event);
        }

        $manager->flush();
    }
}
