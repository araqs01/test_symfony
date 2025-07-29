<?php
namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $services = [
            ['name' => 'Web Design', 'description' => 'Design of websites'],
            ['name' => 'SEO Optimization', 'description' => 'Improve search rankings'],
            ['name' => 'Consulting', 'description' => 'Professional advice'],
        ];

        foreach ($services as $s) {
            $service = new Service();
            $service->setName($s['name']);
            $service->setDescription($s['description']);
            $manager->persist($service);
        }

        $manager->flush();
    }
}
