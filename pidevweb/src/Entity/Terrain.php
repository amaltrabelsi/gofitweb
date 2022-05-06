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
     * @ORM\Column(name="Kid_Friendly", type="string", length=20, nullable=false)
     */
    private $kidFriendly;

    /**
     * @var float
     *
     * @ORM\Column(name="Prix_Res", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixRes;


}
