<?php

namespace App\DataFixtures;

use App\Entity\Person;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
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
        // admin user
        $user = new Person();
        $plainPassword = 'password';
        $encoded = $this->encoder->encodePassword($user, $plainPassword);

        $user->setUsername('admin')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($encoded);

        $manager->persist($user);
        $manager->flush();
    }
}
