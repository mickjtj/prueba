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
     * @Route("/index")
     */
    public function indexAction()
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

    /**
     * @Route("/jugadores")
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
