<?php

namespace App\Entity;
use App\Repository\TerrainRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Terrain
 *@ORM\Entity(repositoryClass=TerraibRepository::class)
 * @ORM\Table(name="terrain")
 * @ORM\Entity
 */
class Terrain
{
    /**
     * @var int
     *
     * @ORM\Column(name="Terrain_Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $terrainId;

    /**
     * @Assert\NotBlank(message="Nom de terrain  doit etre non vide")
     * @var string
     *
     * @ORM\Column(name="Nom_Terrain", type="string", length=30, nullable=false)
     */
    private $nomTerrain;

    /**
     *  @Assert\NotBlank(message="description  doit etre non vide")
     * @Assert\Length(
     *      min = 7,
     *      max =5000,
     *      minMessage = "doit etre >=7 ",
     *      maxMessage = "doit etre <=5000" )
     * @var string
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @Assert\NotBlank(message="l activité doit etre non vide")
     * @var string
     *
     * @ORM\Column(name="Activitie", type="string", length=50, nullable=false)
     */
    private $activitie;

    /**
     * @var string
     *@Assert\NotBlank(message="Saisir votre contatct ")
     * @ORM\Column(name="contact", type="string", length=50, nullable=false)
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="string", length=50, nullable=false)
     */
    private $prix;

    /**
     * @Assert\NotBlank(message="Vous devez saisir un prix en dinars tunisian ")
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @Assert\NotBlank(message="Indiquer votre Région")
     * @var string
     *
     * @ORM\Column(name="Region", type="string", length=50, nullable=false)
     */
    private $region;

    public function getTerrainId(): ?int
    {
        return $this->terrainId;
    }


    public function setTerrainId(int $terrainId): Self
    {
        $this->terrainId = $terrainId;
        return $this;
    }

    /**
     * @return string
     */
    public function getNomTerrain(): ?string
    {
        return $this->nomTerrain;
    }

    /**
     * @param string $nomTerrain
     * @return Terrain
     */
    public function setNomTerrain(string $nomTerrain): Self
    {
        $this->nomTerrain = $nomTerrain;
        return $this;
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
     * @return Terrain
     *
     */
    public function setDescription(string $description): Self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getActivitie(): ?string
    {
        return $this->activitie;
    }

    /**
     * @param string $activitie
     * @return Terrain
     */
    public function setActivitie(string $activitie): Self
    {
        $this->activitie = $activitie;
        return $this;
    }

    /**
     * @return string
     */
    public function getContact(): ?string
    {
        return $this->contact;
    }

    /**
     * @param string $contact
     * @return Terrain
     */
    public function setContact(string $contact): Self
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getPrix(): ?string
    {
        return $this->prix;
    }

    /**
     * @param string $prix
     * @return Terrain
     */
    public function setPrix(string $prix): Self
    {
        $this->prix = $prix;
        return $this;
    }

    public function getImage()
    {
return $this->image;
    }

    public function setImage($image)
    {
$this->image =$image;
    return $this;
    }



    /**
     * @return string
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @param string $region
     * @return Terrain
     */
    public function setRegion(string $region): Self
    {
        $this->region = $region;
        return $this;
    }

    public function __toString()
    {
        return(string)$this->getTerrainId();
    }


}
