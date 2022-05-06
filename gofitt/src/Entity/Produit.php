<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produit
 *
 * @ORM\Table(name="produit", indexes={@ORM\Index(name="FK_businessPp", columns={"FK_Businees"})})
 * @ORM\Entity
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="Produit_Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $produitId;

    /**
     * @var string
     *
     * @ORM\Column(name="Ref_P", type="string", length=50, nullable=false)
     */
    private $refP;

    /**
     * @var float
     *
     * @ORM\Column(name="Prix_Uni", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixUni;

    /**
     * @var int
     *
     * @ORM\Column(name="Quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom_Produit", type="string", length=50, nullable=false)
     */
    private $nomProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="Categorie", type="string", length=50, nullable=false)
     */
    private $categorie;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Path_Image", type="string", length=150, nullable=true, options={"default"="'NULL'"})
     */
    private $pathImage = '\'NULL\'';

    /**
     * @var int|null
     *
     * @ORM\Column(name="Note", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $note = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="totalnote", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $totalnote = NULL;

    /**
     * @var int|null
     *
     * @ORM\Column(name="occurence", type="integer", nullable=true, options={"default"="NULL"})
     */
    private $occurence = NULL;

    /**
     * @var \Business
     *
     * @ORM\ManyToOne(targetEntity="Business")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_Businees", referencedColumnName="Business_Id")
     * })
     */
    private $fkBusinees;


}
