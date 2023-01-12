<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\VehicleRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Monolog\DateTimeImmutable;

/**
 *  /!\ lancer d'abord le dump des véhicules, puis régler le $randVehicule en fonction des ID de vos propres vehicules en base
 *  puis dans un deuxième temps, lancer les fixtures avec l'option "--append" pour ne pas écraser les véhicules
 */
class EventFixtures extends Fixture implements DependentFixtureInterface
{
    private VehicleRepository $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($x = 0; $x < 20; $x++) {
            $event = new Event();
            $randUser = rand(0, 19);
            // à modifier suivant les ID des véhicules dans sa propre BDD
            $randVehicle = rand(51, 100);
            $vehicle = $this->vehicleRepository->findOneBy(['id' => $randVehicle]);

            $startDate = $faker->DateTimeBetween('-15 days', '+15 day');

            // ne marche pas en l'état actuel des choses
            $randNbOfDays = rand(1, 7);
            $endDate = $startDate->modify('+1 day');

            $startKm = $faker->numberBetween(0, 20000);
            $randDistance = $faker->numberBetween(30, 500);
            $returnKm = $startKm + $randDistance;
            $returnStatus = [$returnKm, 0];
            $carStatus = ['available', 'rented', 'maintenance'];
            $returnCondition = ['good', 'medium', 'poor', 'waiting for car return'];
            // on ne peut entrer qu'un integer dans le champ de la plaque
            $numberPlate = rand(10000000, 99999999);

            $event->setUserId($this->getReference('user_' . $randUser));
            $event->setVehicleId($vehicle);
            $event->setStartDate($startDate);
            // le modify ne passe pas ici non plus (voir variables ci-dessus)
            $event->setEndDate($startDate->modify('+1 day'));
            $event->setReturnLocalisation($faker->city);
            $event->setStartCondition('good');
            $event->setReturnCondition($returnCondition[rand(0, 3)]);
            $event->setLicenceNumber($numberPlate);
            $event->setStartKm($startKm);
            $event->setReturnKm($returnStatus[rand(0, 1)]);
            $event->setStatus($carStatus[rand(0, 2)]);
            $event->setCreatedAt(new DateTimeImmutable('now'));

            $manager->persist($event);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
