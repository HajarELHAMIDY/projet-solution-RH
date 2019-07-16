<?php

namespace App\DataFixtures;
use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 0 ; $i < 5 ; $i++){
            $post = new Post();
            $post = setTitle("Tile Num : ",$i);
            $post = setBody("Body Num : ",$i);
            $manager->persist($post);

        }
        

        $manager->flush();
    }
}
