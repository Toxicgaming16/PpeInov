<?php

namespace App\Entity;

use App\Repository\VocabulaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VocabulaireRepository::class)
 */
class Vocabulaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;



    public function __construct()
    {
        $this->themes = new ArrayCollection();
    }
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle_en;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getLibelleEn(): ?string
    {
        return $this->libelle_en;
    }

    public function setLibelleEn(string $libelle_en): self
    {
        $this->libelle_en = $libelle_en;

        return $this;
    }
}
