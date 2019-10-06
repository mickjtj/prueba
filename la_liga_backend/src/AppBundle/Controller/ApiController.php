<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

use AppBundle\Entity\Club;
use AppBundle\Entity\Jugador;
use AppBundle\Form\JugadorType;

/**
 * @Route("/api")
 */
class ApiController extends Controller
{
    /**
     * @Route("/clubes"), methods={"GET"}
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
     * @Route("/jugadores/{club_id}"), requirements={"club_id"="\d+"}, methods={"GET"}
     * @Entity("club", expr="repository.find(club_id)")
     */
    public function jugadoresAction(Club $club)
    {
        $jugadorRepo = $this->getDoctrine()->getRepository(Jugador::class);

        $jugadores = $jugadorRepo->createQueryBuilder('j')
            ->select('j.nombre', 'j.dorsal')
            ->where('j.club = :club')
            ->setParameter(':club', $club)
            ->orderBy('j.dorsal', 'ASC')
            ->getQuery()
            ->getArrayResult();
        return $jugadores;
    }

    /**
     * @Route("/jugadores/"), methods={"POST"}
     */
    public function addJugadoresAction(Request $request)
    {
        if ($request->getMethod() != 'POST') {
            $response = new Response(
                'Bad request',
                Response::HTTP_BAD_REQUEST,
                array('content-type' => 'application/json')
            );
            return $response;
        }

        $jugador = new Jugador();

        $clubRepo = $this->getDoctrine()->getRepository(Club::class);
        $club = $clubRepo->find($request->get('club'));
        $jugador->setNombre($request->get('nombre'));
        $jugador->setDorsal($request->get('dorsal'));
        $jugador->setClub($club);

        try {
            $em = $this->getDoctrine()->getManager();

            $em->persist($jugador);
            $em->flush();
        } catch (\Exception $e) {
            return array('result' => 'ko', 'msg' => $e->getMessage());
        }
       

        return array('result' => 'ok');
    }

    /**
     * @Route("/dorsales/{club_id}"), requirements={"club_id"="\d+"}, methods={"GET"}
     * @Entity("club", expr="repository.find(club_id)")
     */
    public function dorsalesAction(Club $club)
    {
        $jugadorRepo = $this->getDoctrine()->getRepository(Jugador::class);

        $dorsales = $jugadorRepo->createQueryBuilder('j')
            ->select('j.dorsal')
            ->where('j.club = :club')
            ->setParameter(':club', $club)
            ->orderBy('j.dorsal', 'ASC')
            ->getQuery()
            ->getArrayResult();

        $noDisponibles = array();

        foreach ($dorsales as $dorsal) {
            $noDisponibles[] = $dorsal['dorsal'];
        }

        return $noDisponibles;
    }
}
