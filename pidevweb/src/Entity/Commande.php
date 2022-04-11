<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="FK_Panier_Id", columns={"FK_ClientPan_Id"})})
 * @ORM\Entity
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="Commande_Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $commandeId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_C", type="date", nullable=false)
     */
    private $dateC;

    /**
     * @var float
     *
     * @ORM\Column(name="Total", type="float", precision=10, scale=0, nullable=false)
     */
    private $total;

    /**
     * @var int
     *
     * @ORM\Column(name="Nb_Produit", type="integer", nullable=false)
     */
    private $nbProduit;

    /**
     * @var string
     *
     * @ORM\Column(name="Mode_Paiement", type="string", length=50, nullable=false)
     */
    private $modePaiement;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_ClientPan_Id", referencedColumnName="Utilisateur_Id")
     * })
     */
    private $fkClientpan;


}
