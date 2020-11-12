<?php

namespace App\DataFixtures;

use App\Entity\Location;
use App\Entity\Trip;
use App\Entity\Person;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    /**
     * Encodeur de mot de passe
     *
     * @param UserPasswordEncoderInterface $encoder
     */

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("fr_FR");
        for ($u = 0; $u < 10; $u++) {
            $user = new Person();
            $plainPassword = 'password';
            $encoded = $this->encoder->encodePassword($user, $plainPassword);

            $user->setEmail($faker->email)
                ->setPassword($encoded);
            $manager->persist($user);
            for ($t = 0; $t < 3; $t++) {
                $trip = new Trip();
                $trip->setTitle($faker->title())
                     ->setDescription($faker->text())
                     ->setNotation(8);
                     for ($l = 0; $l < 3; $l++) {
                         $location = new Location();
                         $location->setLatitude($faker->randomFloat())
                                    ->setLongitude(mt_rand (-180*10, 180*10) / 10)
                                    ->setTitle($faker->title)
                                    ->setDescription($faker->text())
                                    ->setTrip($trip);
                                    $manager->persist($location);
                     }
                     $manager->persist($trip);
            }
        }

        // admin user
       

        $manager->flush();
    }
}
