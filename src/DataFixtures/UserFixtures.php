<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;

    }

    public function load(ObjectManager $manager,): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setFirstName($faker->firstName());
            $user->setLastName($faker->lastName());
            $user->setEmail($faker->email());
            $user->setPassword(password_hash( '1234', PASSWORD_DEFAULT));
            $user->setAddress($faker->streetAddress());
            $user->setZipCode($faker->numberBetween(11111,99999));
            $user->setCity($faker->city());
            $user->setPhoneNumber($faker->phoneNumber());
            $this->addReference('user_' . $i, $user);
            $manager->persist($user);
        }
        $user = new User();
        $user->setFirstName('Amazon');
        $user->setLastName('Amazon');
        $user->setPhoneNumber($faker->phoneNumber());
        $user->setCity($faker->city);
        $user->setRoles('ROLE_SUPERADMIN');
        $user->setEmail($faker->email());
        $user->setPassword(password_hash( '1234', PASSWORD_DEFAULT));
        $user->setAddress($faker->streetAddress());
        $user->setZipCode($faker->numberBetween(11111,99999));
        $manager->persist($user);


        $manager->flush();
    }
}
