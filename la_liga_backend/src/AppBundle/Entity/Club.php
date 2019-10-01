<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Club
 *
 * @ORM\Table(name="club")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ClubRepository")
 */
class Club
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Jugador", mappedBy="club")
     */
    private $jugadores;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="estadio", type="string", length=50)
     */
    private $estadio;

    public function __construct()
    {
        $this->jugadores = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Club
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set estadio
     *
     * @param string $estadio
     *
     * @return Club
     */
    public function setEstadio($estadio)
    {
        $this->estadio = $estadio;

        return $this;
    }

    /**
     * Get estadio
     *
     * @return string
     */
    public function getEstadio()
    {
        return $this->estadio;
    }

    /**
     * Add jugador
     *
     * @param \AppBundle\Entity\Jugador $jugador
     *
     * @return Club
     */
    public function addJugador(\AppBundle\Entity\Jugador $jugador)
    {
        $this->jugadores[] = $jugador;

        return $this;
    }

    /**
     * Remove jugador
     *
     * @param \AppBundle\Entity\Jugador $jugador
     */
    public function removeJugador(\AppBundle\Entity\Jugador $jugador)
    {
        $this->jugadores->removeElement($jugador);
    }

    /**
     * Get jugadores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getJugadores()
    {
        return $this->jugadores;
    }
}
