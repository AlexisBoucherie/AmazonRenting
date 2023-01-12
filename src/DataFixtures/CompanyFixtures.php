<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CompanyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 20; $i++) {
            $company = new Company();
            $company->setName($faker->company());
            $company->setSiret($faker->siret());
            $company->setEmail($faker->email());
            $company->setPassword(password_hash('1234', PASSWORD_DEFAULT));
            $company->setAddress($faker->streetAddress());
            $company->setZipCode($faker->numberBetween(11111, 99999));
            $company->setCity($faker->city);
            $manager->persist($company);
        }
        $manager->flush();
    }
}
