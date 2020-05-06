<?php

namespace App\DataFixtures;

use App\Entity\Beer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BeerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->data() as [$style, $volume, $alcohol, $name, $brewer, $country, $color]) {
            $beer = new Beer();
            $beer->setStyle($style);
            $beer->setVolume($volume);
            $beer->setAlcohol($alcohol);
            $beer->setName($name);
            $beer->setBrewer($brewer);
            $beer->setCountry($country);
            $beer->setColor($color);

            $manager->persist($beer);
        }


        $manager->flush();
    }

    private function data(): \Generator
    {
        yield ['Triple', 33, 840, 'Tripel Karmeliet', 'Bosteels', 'Belgium', 'Blonde'];
        yield ['Flandres Red', 25, 630, 'Duchesse de Bourgogne', 'Verhaeghe', 'Belgium', 'Brown'];
        yield ['IPA', 33, 560, 'Brewdog Punk IPA', 'Brewdog', 'Belgium', 'Blonde'];
        yield ['IPA', 33, 560, 'Canopée', 'BAPBAP', 'France', 'Blonde'];
        yield ['Pale Ale', 33, 580, 'Originale', 'BAPBAP', 'France', 'Blonde'];
        yield ['IPA', 33, 600, 'Vertigo', 'BAPBAP', 'France', 'Red'];
        yield ['Doppelbock', 33, 760, 'Elevator', 'BAPBAP', 'France', 'Brown'];
    }
}
