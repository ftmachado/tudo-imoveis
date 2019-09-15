<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="bairro")
 * @ORM\Entity(repositoryClass="App\Repository\BairroRepository")
 */
class Bairro
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nome;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cidade")
     * @ORM\JoinColumn(name="fk_cidade_id")
     */
    private $fkCidadeId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getFkCidadeId(): ?Cidade
    {
        return $this->fkCidadeId;
    }

    public function setFkCidadeId(?Cidade $fkCidadeId): self
    {
        $this->fkCidadeId = $fkCidadeId;

        return $this;
    }
}
