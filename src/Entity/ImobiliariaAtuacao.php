<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="imobiliaria_atuacao")
 * @ORM\Entity(repositoryClass="App\Repository\ImobiliariaAtuacaoRepository")
 */
class ImobiliariaAtuacao
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Imobiliaria")
     * @ORM\JoinColumn(name="fk_imobiliaria_id")
     */
    private $fkImobiliariaId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Estado")
     * @ORM\JoinColumn(name="fk_estado_id")
     */
    private $fkEstadoId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cidade")
     * @ORM\JoinColumn(name="fk_cidade_id")
     */
    private $fkCidadeId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFkImobiliariaId(): ?Imobiliaria
    {
        return $this->fkImobiliariaId;
    }

    public function setFkImobiliariaId(?Imobiliaria $fkImobiliariaId): self
    {
        $this->fkImobiliariaId = $fkImobiliariaId;

        return $this;
    }

    public function getFkEstadoId(): ?Estado
    {
        return $this->fkEstadoId;
    }

    public function setFkEstadoId(?Estado $fkEstadoId): self
    {
        $this->fkEstadoId = $fkEstadoId;

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
