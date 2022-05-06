<?php

namespace App\Entity;
use App\Entity\Terrain;
use App\Entity\Utilisateur;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="Fk_utilisateurRec_Id", columns={"Fkutilisateur"}), @ORM\Index(name="FkterrainRecId", columns={"FkterrainRecId"})})
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="Reclamation_Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $reclamationId;


    /**
     * @var string
     *
     * @ORM\Column(name="Contenu", type="text", length=65535, nullable=false)
     * @Assert\Length(
     * min =20,
     * max = 100000,
     * minMessage = "Votre Réclamation doit contenir au moins 20 caractères",
     * maxMessage = "Votre Réclamation doit contenir au plus 100000 caractères",
     * allowEmptyString = false
     * )
     */
    private $contenu;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Terrain")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FkterrainRecId", referencedColumnName="Terrain_Id")
     * })
     */
    private $fkTerrainrec;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Fkutilisateur", referencedColumnName="Utilisateur_Id")
     * })
     */
    private $fkutilisateur;

    /**
     * @return int
     */
    public function getReclamationId(): int
    {
        return $this->reclamationId;
    }

    /**
     * @param int $reclamationId
     * @return Reclamation
     */
    public function setReclamationId(int $reclamationId): Reclamation
    {
        $this->reclamationId = $reclamationId;
        return $this;
    }


    /**
     * @return string
     */
    public function getContenu(): ? string
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     * @return Reclamation
     */
    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;
        return $this;
    }



    public function getFkterrainRecId(): ?Terrain
    {
        return $this->fkTerrainrec;
    }

    public function setFkterrainRecId($fkTerrainrec) : self
    {
        $this->fkTerrainrec = $fkTerrainrec;
        return $this;
    }




    public function getFkutilisateur(): ?Utilisateur
    {
        return $this->fkutilisateur;
    }

    public function setFkutilisateur(?Utilisateur $fkutilisateur): self
    {
        $this->fkutilisateur = $fkutilisateur;

        return $this;
    }

}
