<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Business
 *
 * @ORM\Table(name="business", indexes={@ORM\Index(name="CompteHer_Id", columns={"User_Id"})})
 * @ORM\Entity
 */
class Business
{
    /**
     * @var int
     *
     * @ORM\Column(name="Business_Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $businessId;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Business", type="string", length=30, nullable=false)
     */
    private $nomBusiness;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Gerant", type="string", length=30, nullable=false)
     */
    private $nomGerant;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom_Gerant", type="string", length=30, nullable=false)
     */
    private $prenomGerant;

    /**
     * @var string
     *
     * @ORM\Column(name="Region", type="string", length=30, nullable=false)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=100, nullable=false)
     */
    private $adresse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Fondation", type="date", nullable=false)
     */
    private $dateFondation;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Tel_Portable", type="string", length=10, nullable=false)
     */
    private $telPortable;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Tel_Fix", type="string", length=10, nullable=true, options={"default"="NULL"})
     */
    private $telFix = 'NULL';

    /**
     * @var string
     *
     * @ORM\Column(name="Path_Image", type="text", length=65535, nullable=false)
     */
    private $pathImage;

    /**
     * @var int|null
     *
     * @ORM\Column(name="Note", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $note = NULL;

    /**
     * @var int
     *
     * @ORM\Column(name="totalnote", type="integer", nullable=false)
     */
    private $totalnote;

    /**
     * @var int
     *
     * @ORM\Column(name="occurence", type="integer", nullable=false)
     */
    private $occurence;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="User_Id", referencedColumnName="Utilisateur_Id")
     * })
     */
    private $user;


}
