<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panier
 *
 * @ORM\Table(name="panier", indexes={@ORM\Index(name="FK_userClient", columns={"FK_UserClient"}), @ORM\Index(name="Fk_ProduitP_Id", columns={"Fk_ProduitP_Id"})})
 * @ORM\Entity
 */
class Panier
{
    /**
     * @var int
     *
     * @ORM\Column(name="PanierAjout_Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $panierajoutId;

    /**
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Fk_ProduitP_Id", referencedColumnName="Produit_Id")
     * })
     */
    private $fkProduitp;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_UserClient", referencedColumnName="Utilisateur_Id")
     * })
     */
    private $fkUserclient;


}
