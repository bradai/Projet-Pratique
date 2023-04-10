<?php

namespace App\Entity;

use App\Traits\TimeStampTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\FactureRepository")
 */
class Facture
{
    use TimeStampTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $designation;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    private $prixTotalHT;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Article", inversedBy="factures")
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrixTotalHT(): ?string
    {
        return $this->prixTotalHT;
    }

    public function setPrixTotalHT(string $prixTotalHT): self
    {
        $this->prixTotalHT = $prixTotalHT;

        return $this;
    }

    public function getPrixTotalTTC(float $tvaRate = 0.2): ?string
    {
        $totalTTC = 0;
        foreach ($this->articles as $article) {
            $totalTTC += $article->getPrix() * (1 + $tvaRate);
        }

        return $totalTTC;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->addFacture($this);
        }

        return $this;
    }


    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            $article->removeFacture($this);
        }

        return $this;
    }
}
