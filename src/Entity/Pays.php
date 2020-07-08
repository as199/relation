<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaysRepository::class)
 */
class Pays
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
    private $nomPays;

    /**
     * @ORM\Column(type="integer")
     */
    private $superficie;

    /**
     * @ORM\Column(type="integer")
     */
    private $totalPopulation;

    /**
     * @ORM\ManyToMany(targetEntity=Voiture::class, mappedBy="pays")
     */
    private $pays;

    public function __construct()
    {
        $this->pays = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPays(): ?string
    {
        return $this->nomPays;
    }

    public function setNomPays(string $nomPays): self
    {
        $this->nomPays = $nomPays;

        return $this;
    }

    public function getSuperficie(): ?int
    {
        return $this->superficie;
    }

    public function setSuperficie(int $superficie): self
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getTotalPopulation(): ?int
    {
        return $this->totalPopulation;
    }

    public function setTotalPopulation(int $totalPopulation): self
    {
        $this->totalPopulation = $totalPopulation;

        return $this;
    }

    /**
     * @return Collection|Voiture[]
     */
    public function getPays(): Collection
    {
        return $this->pays;
    }

    public function addPay(Voiture $pay): self
    {
        if (!$this->pays->contains($pay)) {
            $this->pays[] = $pay;
            $pay->addPay($this);
        }

        return $this;
    }

    public function removePay(Voiture $pay): self
    {
        if ($this->pays->contains($pay)) {
            $this->pays->removeElement($pay);
            $pay->removePay($this);
        }

        return $this;
    }
}
