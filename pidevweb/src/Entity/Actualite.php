<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vangrg\ProfanityBundle\Validator\Constraints as ProfanityAssert;

/**
 * Actualite
 *
 * @ORM\Table(name="actualite", indexes={@ORM\Index(name="FK_UserC_Id", columns={"FK_user_Id"})})
 * @ORM\Entity
 */
class Actualite
{
    /**
     * @var int
     *
     * @ORM\Column(name="Actualite_Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $actualiteId;

    /**
     * @var string
     *   @Assert\NotBlank(message="Le titre doit etre non vide!")
     * @Assert\Length(
     *      min = 10,
     *      max = 50,
     *      minMessage = "Veuillez saisir un titre valide >=10",
     *      maxMessage = "Veuillez saisir un titre valide <=50" )
     * @ProfanityAssert\ProfanityCheck
     * @ORM\Column(name="Titre", type="string", length=50, nullable=false)
     */
    public $titre;

    /**
     * @var string
     *   @Assert\NotBlank(message="La description doit etre non vide!")
     * @Assert\Length(
     *      min = 10,
     *      max = 200,
     *      minMessage = "Veuillez saisir une description valide >=10",
     *      maxMessage = "Veuillez saisir une description valide <=200" )
     * @ProfanityAssert\ProfanityCheck
     * @ORM\Column(name="Description", type="string", length=200, nullable=false)
     */
    public $description;

    /**
     * @var string
     *   @Assert\NotBlank(message="Le contenu doit etre non vide!")
     * @Assert\Length(
     *      min = 10,
     *      max = 6500,
     *      minMessage = "Veuillez saisir un contenu valide >=10",
     *      maxMessage = "Veuillez saisir un contenu valide <=6500" )
     * @ProfanityAssert\ProfanityCheck
     * @ORM\Column(name="Contenu", type="text", length=65535, nullable=false)
     */
    public $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="Categorie", type="string", length=50, nullable=false)
     */
    public $categorie;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Path_Image", type="string", length=450, nullable=true, options={"default"="NULL"})
     */
    public $pathImage = 'NULL';

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_user_Id", referencedColumnName="Utilisateur_Id")
     * })
     */
    public $fkUser;


}
