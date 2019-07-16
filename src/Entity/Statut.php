<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatutRepository")
 */
class Statut
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameStatut;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameStatut(): ?string
    {
        return $this->nameStatut;
    }

    public function setNameStatut(string $nameStatut): self
    {
        $this->nameStatut = $nameStatut;

        return $this;
    }

}
