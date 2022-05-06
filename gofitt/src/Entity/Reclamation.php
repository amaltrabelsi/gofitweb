<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="Fk_terrainRec_Id", columns={"Fk_terrainRec_Id"}), @ORM\Index(name="Fk_utilisateurRec_Id", columns={"Fkutilisateur"})})
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="Reclamation_Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $reclamationId;

    /**
     * @var string
     *
     * @ORM\Column(name="Categorie", type="string", length=8, nullable=false)
     */
    private $categorie;

    /**
     * @var string
     *
     * @ORM\Column(name="Contenu", type="text", length=65535, nullable=false)
     */
    private $contenu;

    /**
     * @var \Terrain
     *
     * @ORM\ManyToOne(targetEntity="Terrain")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Fk_terrainRec_Id", referencedColumnName="Terrain_Id")
     * })
     */
    private $fkTerrainrec;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Fkutilisateur", referencedColumnName="Utilisateur_Id")
     * })
     */
    private $fkutilisateur;


}
