<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
<<<<<<< Updated upstream
=======
use Symfony\Component\Validator\Constraints as Assert;
>>>>>>> Stashed changes

/**
 * Business
 *
 * @ORM\Table(name="business", indexes={@ORM\Index(name="CompteHer_Id", columns={"User_Id"})})
 * @ORM\Entity(repositoryClass="App\Repository\BusinessRepository")
 */
<<<<<<< Updated upstream
=======



>>>>>>> Stashed changes
class Business
{
    /**
     * @var int
     *
     * @ORM\Column(name="Business_Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
<<<<<<< Updated upstream
    private $businessId;

    /**
=======

    private $businessId;

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
>>>>>>> Stashed changes
     * @var string
     *
     * @ORM\Column(name="Nom_Business", type="string", length=30, nullable=false)
     */
    private $nomBusiness;
<<<<<<< Updated upstream
    public function __toString() {
        return $this->nomBusiness;
    }

    /**
=======

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
>>>>>>> Stashed changes
     * @var string
     *
     * @ORM\Column(name="Nom_Gerant", type="string", length=30, nullable=false)
     */
<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes
    private $nomGerant;

    /**
     * @var string
     *
<<<<<<< Updated upstream
     * @ORM\Column(name="Prenom_Gerant", type="string", length=30, nullable=false)
     */
    private $prenomGerant;

    /**
     * @var string
     *
=======
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

    private $prenomGerant;





    /**
     * @var string
     *
     *
>>>>>>> Stashed changes
     * @ORM\Column(name="Region", type="string", length=30, nullable=false)
     */
    private $region;

<<<<<<< Updated upstream
    /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=100, nullable=false)
     */
    private $adresse;
=======





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
    private  $adresse;
>>>>>>> Stashed changes

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Fondation", type="date", nullable=false)
     */
    private $dateFondation;

<<<<<<< Updated upstream
    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=false)
     */
=======

    /**

     *   @Assert\NotBlank(message="Décrire la boutique")
     * @Assert\Length(
     *      min = 3,
     *      max = 100,
     *      minMessage = "Veuillez saisir une description valide>=2",
     *      maxMessage = "Veuillez saisir une description valide <=100" )
     * @ORM\Column(name="Description", type="text", length=65535, nullable=false)
     * @var string
     */

>>>>>>> Stashed changes
    private $description;

    /**
     * @var string
     *
<<<<<<< Updated upstream
=======
     * @Assert\Length(min = 8, max = 14, minMessage = "min_lenght", maxMessage = "max_lenght")

>>>>>>> Stashed changes
     * @ORM\Column(name="Tel_Portable", type="string", length=10, nullable=false)
     */
    private $telPortable;

    /**
     * @var string|null
<<<<<<< Updated upstream
     *
     * @ORM\Column(name="Tel_Fix", type="string", length=10, nullable=true, options={"default"="NULL"})
     */
    private $telFix = 'NULL';

    /**
     * @var string
=======
     * @Assert\Length(min = 8, max = 14, minMessage = "min_lenght", maxMessage = "max_lenght")
     * @ORM\Column(name="Tel_Fix", type="string", length=10, nullable=false)
     */

    private $telFix ;

    /**
     * @var string|null
>>>>>>> Stashed changes
     *
     * @ORM\Column(name="Path_Image", type="text", length=65535, nullable=false)
     */
    private $pathImage;

<<<<<<< Updated upstream
=======


>>>>>>> Stashed changes
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

    /**
<<<<<<< Updated upstream
=======
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

    /**
>>>>>>> Stashed changes
     * @return int
     */
    public function getBusinessId(): int
    {
        return $this->businessId;
    }

    /**
     * @param int $businessId
     */
    public function setBusinessId(int $businessId): void
    {
        $this->businessId = $businessId;
    }

    /**
     * @return string
     */
<<<<<<< Updated upstream
    public function getNomBusiness(): string
=======
    public function getNomBusiness(): ?string
>>>>>>> Stashed changes
    {
        return $this->nomBusiness;
    }

    /**
     * @param string $nomBusiness
     */
    public function setNomBusiness(string $nomBusiness): void
    {
        $this->nomBusiness = $nomBusiness;
    }

    /**
     * @return string
     */
<<<<<<< Updated upstream
    public function getNomGerant(): string
=======
    public function getNomGerant(): ?string
>>>>>>> Stashed changes
    {
        return $this->nomGerant;
    }

    /**
     * @param string $nomGerant
     */
    public function setNomGerant(string $nomGerant): void
    {
        $this->nomGerant = $nomGerant;
    }

    /**
     * @return string
     */
<<<<<<< Updated upstream
    public function getPrenomGerant(): string
=======
    public function getPrenomGerant(): ?string
>>>>>>> Stashed changes
    {
        return $this->prenomGerant;
    }

    /**
     * @param string $prenomGerant
     */
    public function setPrenomGerant(string $prenomGerant): void
    {
        $this->prenomGerant = $prenomGerant;
    }

    /**
     * @return string
     */
<<<<<<< Updated upstream
    public function getRegion(): string
=======
    public function getRegion(): ?string
>>>>>>> Stashed changes
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    /**
     * @return string
     */
<<<<<<< Updated upstream
    public function getAdresse(): string
=======
    public function getAdresse(): ?string
>>>>>>> Stashed changes
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * @return \DateTime
     */
<<<<<<< Updated upstream
    public function getDateFondation(): \DateTime
=======
    public function getDateFondation(): ?\DateTimeInterface
>>>>>>> Stashed changes
    {
        return $this->dateFondation;
    }

    /**
     * @param \DateTime $dateFondation
     */
    public function setDateFondation(\DateTime $dateFondation): void
    {
        $this->dateFondation = $dateFondation;
    }

    /**
     * @return string
     */
<<<<<<< Updated upstream
    public function getDescription(): string
=======
    public function getDescription(): ?string
>>>>>>> Stashed changes
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
<<<<<<< Updated upstream
    public function getTelPortable(): string
=======
    public function getTelPortable(): ?string
>>>>>>> Stashed changes
    {
        return $this->telPortable;
    }

    /**
     * @param string $telPortable
     */
    public function setTelPortable(string $telPortable): void
    {
        $this->telPortable = $telPortable;
    }

    /**
     * @return string|null
     */
    public function getTelFix(): ?string
    {
        return $this->telFix;
    }

    /**
     * @param string|null $telFix
     */
    public function setTelFix(?string $telFix): void
    {
        $this->telFix = $telFix;
    }

    /**
<<<<<<< Updated upstream
     * @return string
     */
    public function getPathImage(): string
    {
        return $this->pathImage;
    }

    /**
     * @param string $pathImage
     */
    public function setPathImage(string $pathImage): void
    {
        $this->pathImage = $pathImage;
    }

    /**
=======
>>>>>>> Stashed changes
     * @return int|null
     */
    public function getNote(): ?int
    {
        return $this->note;
    }

    /**
     * @param int|null $note
     */
    public function setNote(?int $note): void
    {
        $this->note = $note;
    }

    /**
     * @return int
     */
    public function getTotalnote(): int
    {
        return $this->totalnote;
    }

    /**
     * @param int $totalnote
     */
    public function setTotalnote(int $totalnote): void
    {
        $this->totalnote = $totalnote;
    }

    /**
     * @return int
     */
    public function getOccurence(): int
    {
        return $this->occurence;
    }

    /**
     * @param int $occurence
     */
    public function setOccurence(int $occurence): void
    {
        $this->occurence = $occurence;
    }

<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
    /**
     * @return \Utilisateur|null
     */
    public function getUser(): ?Utilisateur
    {
        return $this->user;
    }


    public function setUser(?Utilisateur $user): self
    {
        $this->user = $user;
        return $this;
    }

<<<<<<< Updated upstream
=======


>>>>>>> Stashed changes
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Produit", mappedBy="business"
     * )
     */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }
<<<<<<< Updated upstream
}
=======

}
>>>>>>> Stashed changes
