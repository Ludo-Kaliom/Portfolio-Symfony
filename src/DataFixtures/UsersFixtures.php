<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{

    public function __construct(
        private UserPasswordHasherInterface $hasher
    ) {}
    
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('Admin@admin.com');
        $admin->setPassword($this->hasher->hashPassword($admin, 'Admin@admin.com'));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $manager->flush();
    }
}
