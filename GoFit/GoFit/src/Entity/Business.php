<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Business
 *
 * @ORM\Table(name="business", indexes={@ORM\Index(name="CompteHer_Id", columns={"User_Id"})})
 * @ORM\Entity(repositoryClass="App\Repository\BusinessRepository")
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
    public function __toString() {
        return $this->nomBusiness;
    }

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

    /**
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
    public function getNomBusiness(): string
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
    public function getNomGerant(): string
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
    public function getPrenomGerant(): string
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
    public function getRegion(): string
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
    public function getAdresse(): string
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
    public function getDateFondation(): \DateTime
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
    public function getDescription(): string
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
    public function getTelPortable(): string
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
}
