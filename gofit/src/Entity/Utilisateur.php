<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity
 */
class Utilisateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="Utilisateur_Id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $utilisateurId;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;


    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="string", length=50, nullable=false)
     */
    private $roles;

    /**
     * @var string
     *
     * @ORM\Column(name="Mdp", type="string", length=50, nullable=false)
     */
    private $mdp;

    /**
     * @var string
     *
     * @ORM\Column(name="num", type="string", length=50, nullable=false)
     */
    private $num;

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Utilisateur
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return int
     */
    public function getUtilisateurId(): ?int
    {
        return $this->utilisateurId;
    }

    /**
     * @param int $utilisateurId
     * @return Utilisateur
     */
    public function setUtilisateurId($utilisateurId): self
    {
        $this->utilisateurId = $utilisateurId;
        return $this;
    }


    public function __toString()
    {
        return(string)$this->getUtilisateurId();
    }

}
