<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Entity\Club;
use AppBundle\Entity\Jugador;

/**
 * @Route("/api")
 */
class ApiController extends Controller
{
    /**
     * @Route("/get-clubes")
     */
    public function getClubesAction()
    {
        $clubRepo = $this->getDoctrine()->getRepository(Club::class);
        $clubes = $clubRepo->createQueryBuilder('c')
                            ->orderBy('c.nombre', 'ASC')
                            ->getQuery()
                            ->getArrayResult();
        
        return $clubes;
    }

    /**
     * @Route("/get-jugadores/{club_id}"), requirements={"club"="\d+"}
     */
    public function getJugadoresAction($club_id)
    {
        $clubRepo = $this->getDoctrine()->getRepository(Club::class);
        $club = $clubRepo->find($club_id);
        $jugadorRepo = $this->getDoctrine()->getRepository(Jugador::class);
        $jugadores = $club->getJugadores();
        $jugadores = $jugadorRepo->createQueryBuilder('j')
                                ->where('j.club = :club')
                                ->setParameter(':club', $club)
                                ->orderBy('j.dorsal', 'ASC')
                                ->getQuery()
                                ->getArrayResult();        
        return $jugadores;
    }

}
