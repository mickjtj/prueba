<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use AppBundle\Entity\Club;

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
     * @Route("/get-jugadores")
     */
    public function jugadoresAction()
    {
        $clubes = array("Clubes" => array(
            array(
                "nombre"   => "Real Madrid",
                "estadio" => "Santiago Bernabéu"
            ),
            array(
                "nombre"   => "Atlético de Madrid",
                "estadio" => "Wanda Metropolitano"
            )));
    
        
        return $clubes;
    }

}
