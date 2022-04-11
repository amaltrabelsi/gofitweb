<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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

    public $businessId;

    /**
     * @Assert\NotBlank(message="nom business doit etre non vide")
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Veuillez saisir une marque valide
     *
     *
     * >=2",
     *      maxMessage = "Veuillez saisir une marque valide <=100" )
     * @var string
     *
     * @ORM\Column(name="Nom_Business", type="string", length=30, nullable=false)
     */
    public $nomBusiness;

    /**
     * @Assert\NotBlank(message="nom gérant doit etre non vide")
     * @Assert\Length(
     *      min = 3,
     *      max = 100,
     *      minMessage = "Veuillez saisir un nom valide
     *
     *
     * >=3",
     *      maxMessage = "Veuillez saisir un nom valide <=100" )
     * @var string
     *
     * @ORM\Column(name="Nom_Gerant", type="string", length=30, nullable=false)
     */
   public $nomGerant;

    /**
     * @var string
     *
     *   @Assert\NotBlank(message="nom business doit etre non vide")
     * @Assert\Length(
     *      min = 3,
     *      max = 100,
     *      minMessage = "Veuillez saisir un prénom valide
     *
     *
     * >=2",
     *      maxMessage = "Veuillez saisir une pfdnom valide <=100" )
     * @ORM\Column(name="Prenom_Gerant", type="string", length=30, nullable=false)
     */
    public $prenomGerant;





    /**
     * @var string
     *
     *
     * @ORM\Column(name="Region", type="string", length=30, nullable=false)
     */
 public $region;






    /**
     * @var string
     *   @Assert\NotBlank(message="L'adresse doit etre non-vide")
     * @Assert\Length(
     *      min = 10,
     *      max = 100,
     *      minMessage = "Veuillez saisir une adresse valide >10car")
     *      maxMessage = "Veuillez saisir une adresse valide <=100car" )
     * @ORM\Column(name="Adresse", type="string", length=100, nullable=false)
     */
 public $adresse;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Fondation", type="date", nullable=false)
     */
    public $dateFondation;

    /**
     * @var string
     *   @Assert\NotBlank(message="Décrire la boutique")
     * @Assert\Length(
     *      min = 3,
     *      max = 100,
     *      minMessage = "Veuillez saisir une description valide
     *
     *
     * >=2",
     *      maxMessage = "Veuillez saisir une description valide <=100" )
     * @ORM\Column(name="Description", type="text", length=65535, nullable=false)
     */
   public $description;

    /**
     * @var string
     *
   * @Assert\Length(min = 8, max = 14, minMessage = "min_lenght", maxMessage = "max_lenght")

     * @ORM\Column(name="Tel_Portable", type="string", length=10, nullable=false)
     */
    public $telPortable;

    /**
     * @var string|null
     * @Assert\Length(min = 8, max = 14, minMessage = "min_lenght", maxMessage = "max_lenght")
     * @ORM\Column(name="Tel_Fix", type="string", length=10, nullable=false)
     */

    public $telFix ;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Path_Image", type="text", length=65535, nullable=false)
     */
    private $pathImage;



    /**
     * @var int|null
     *
     * @ORM\Column(name="Note", type="integer", nullable=true, options={"default"="NULL"})
     */
    public $note = NULL;

    /**
     * @var int
     *
     * @ORM\Column(name="totalnote", type="integer", nullable=false)
     */
    public $totalnote;

    /**
     * @var int
     *
     * @ORM\Column(name="occurence", type="integer", nullable=false)
     */
    public $occurence;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="User_Id", referencedColumnName="Utilisateur_Id")
     * })
     */
    public $user;

    /**
     * @return string|null
     */
    public function getPathImage(): ?string
    {
        return $this->pathImage;
    }

    /**
     * @param string|null $pathImage
     */
    public function setPathImage(?string $pathImage): void
    {
        $this->pathImage = $pathImage;
    }
}
