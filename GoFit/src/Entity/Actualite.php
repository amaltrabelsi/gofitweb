<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
<<<<<<< Updated upstream
=======
use Symfony\Component\Validator\Constraints as Assert;
use Vangrg\ProfanityBundle\Validator\Constraints as ProfanityAssert;
use App\Repository\ActualiteRepository;
>>>>>>> Stashed changes

/**
 * Actualite
 *
 * @ORM\Table(name="actualite", indexes={@ORM\Index(name="FK_UserC_Id", columns={"FK_user_Id"})})
 * @ORM\Entity
<<<<<<< Updated upstream
 */
=======
 *
 * @ORM\Entity(repositoryClass=ActualiteRepository::class)
 */

>>>>>>> Stashed changes
class Actualite
{
    /**
     * @var int
     *
     * @ORM\Column(name="Actualite_Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
<<<<<<< Updated upstream
    private $actualiteId;

    /**
     * @var string
     *
     * @ORM\Column(name="Titre", type="string", length=50, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=200, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Contenu", type="text", length=65535, nullable=false)
     */
    private $contenu;
=======
    public $actualiteId;

    /**
     * @var string
     *   @Assert\NotBlank(message="Le titre doit etre non vide!")
     * @Assert\Length(
     *      min = 10,
     *      max = 50,
     *      minMessage = "Veuillez saisir un titre valide >=10",
     *      maxMessage = "Veuillez saisir un titre valide <=50" )
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
     * @ORM\Column(name="Contenu", type="text", length=65535, nullable=false)
     */
    public $contenu;
>>>>>>> Stashed changes

    /**
     * @var string
     *
     * @ORM\Column(name="Categorie", type="string", length=50, nullable=false)
     */
<<<<<<< Updated upstream
    private $categorie;
=======
    public $categorie;
>>>>>>> Stashed changes

    /**
     * @var string|null
     *
     * @ORM\Column(name="Path_Image", type="string", length=450, nullable=true, options={"default"="NULL"})
     */
<<<<<<< Updated upstream
    private $pathImage = 'NULL';
=======
    public $pathImage = 'NULL';
>>>>>>> Stashed changes

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FK_user_Id", referencedColumnName="Utilisateur_Id")
     * })
     */
<<<<<<< Updated upstream
    private $fkUser;
=======
    public $fkUser;
    public function getPathImage(): ?string
    {
        return $this->pathImage;
    }


    public function setPathImage($pathImage): self
    {
        $this->pathImage = $pathImage;
        return $this;
    }
    /**
     * @return int
     */
    public function getActualiteId(): int
    {
        return $this->actualiteId;
    }

    /**
     * @param int $actualiteId
     */
    public function setActualiteId(int $actualiteId): void
    {
        $this->actualiteId= $actualiteId;
    }

    /**
     * @return string
     */
    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     */
    public function setContenu(string $contenu): void
    {
        $this->contenu = $contenu;
    }

    /**
     * @return string
     */
    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    /**
     * @param string $categorie
     */
    public function setCategorie(string $categorie): void
    {
        $this->categorie = $categorie;
    }

    /**
     * @return string
     */
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
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
     * @return \Utilisateur
     */
    public function getFkUser(): \Utilisateur
    {
        return $this->fkUser;
    }

    /**
     * @param \Utilisateur $fkUser
     */
    public function setFkUser(\Utilisateur $fkUser): void
    {
        $this->fkUser = $fkUser;
    }
>>>>>>> Stashed changes


}
