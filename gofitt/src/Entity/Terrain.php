<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Terrain
 *
 * @ORM\Table(name="terrain")
 * @ORM\Entity
 */
class Terrain
{
    /**
     * @var int
     *
     * @ORM\Column(name="Terrain_Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $terrainId;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Terrain", type="string", length=30, nullable=false)
     */
    private $nomTerrain;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Activitie", type="string", length=50, nullable=false)
     */
    private $activitie;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=50, nullable=false)
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="string", length=50, nullable=false)
     */
    private $prix;


}
