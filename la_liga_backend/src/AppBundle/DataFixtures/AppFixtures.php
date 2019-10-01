<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Club;
use AppBundle\Entity\Jugador;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Generar 20 clubes
        for ($i = 1; $i <= 20; $i++) {
            $club = new Club();
            $club->setNombre('Club ' . $i);
            $club->setEstadio('Estadio ' . $i);

            // Generar 25 jugadores para cada club
            for ($x=1; $x <= 25; $x++) { 
                $jugador = new Jugador();
                $jugador->setNombre('Jugador ' . $x);
                $jugador->setDorsal($x);
                $jugador->setClub($club);
                $manager->persist($jugador);
            }

            $manager->persist($club);
        }

        $manager->flush();
    }
}