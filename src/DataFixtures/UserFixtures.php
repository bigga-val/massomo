<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setEmail('val@gmail.com');
        $user->setRoles(['Secretaire']);
        $user->setNomComplet('val Bigga');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'valery'));

        $user1 = new User();
        $user1->setEmail('chris@gmail.com');
        $user1->setRoles(['directeur']);
        $user1->setNomComplet("chris msp");
        $user1->setPassword(($this->passwordEncoder->encodePassword($user1,'chrislmb')));
        $manager->persist($user1);
        $manager->persist($user);
        $manager->flush();
    }
}
