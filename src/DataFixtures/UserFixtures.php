<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setUsername('admin')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->encoder->encodePassword($user, 'admin2020@@'));

        $user2 = new User();
        $user2
            ->setUsername('user')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->encoder->encodePassword($user, 'user'));

        $manager->persist($user);


        $manager->flush();
    }
}
