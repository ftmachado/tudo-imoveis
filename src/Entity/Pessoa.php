<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="pessoa")
 * @ORM\Entity(repositoryClass="App\Repository\PessoaRepository")
 */
class Pessoa
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=11)
     */
    private $cpf;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $rg;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(name="telefone_principal", type="string", length=15, nullable=true)
     */
    private $telefonePrincipal;

    /**
     * @ORM\Column(name="telefone_secundario", type="string", length=15, nullable=true)
     */
    private $telefoneSecundario;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $usuario;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $senha;

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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $endereco;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $cep;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $complemento;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bairro")
     * @ORM\JoinColumn(name="fk_bairro_id")
     */
    private $fkBairroId;

    /**
     * @ORM\Column(type="boolean", options={"default":1, "comment":"1=Sim, 0=Não"})
     */
    private $cliente;

    /**
     * @ORM\Column(type="boolean", options={"default":0, "comment":"1=Sim, 0=Não"})
     */
    private $administrador;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getRg(): ?string
    {
        return $this->rg;
    }

    public function setRg(?string $rg): self
    {
        $this->rg = $rg;

        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefonePrincipal(): ?string
    {
        return $this->telefonePrincipal;
    }

    public function setTelefonePrincipal(?string $telefonePrincipal): self
    {
        $this->telefonePrincipal = $telefonePrincipal;

        return $this;
    }

    public function getTelefoneSecundario(): ?string
    {
        return $this->telefoneSecundario;
    }

    public function setTelefoneSecundario(?string $telefoneSecundario): self
    {
        $this->telefoneSecundario = $telefoneSecundario;

        return $this;
    }

    public function getUsuario(): ?string
    {
        return $this->usuario;
    }

    public function setUsuario(?string $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(?string $senha): self
    {
        $this->senha = $senha;

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

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(?string $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(?int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getCep(): ?string
    {
        return $this->cep;
    }

    public function setCep(?string $cep): self
    {
        $this->cep = $cep;

        return $this;
    }

    public function getComplemento(): ?string
    {
        return $this->complemento;
    }

    public function setComplemento(?string $complemento): self
    {
        $this->complemento = $complemento;

        return $this;
    }

    public function getFkBairroId(): ?Bairro
    {
        return $this->fkBairroId;
    }

    public function setFkBairroId(?Bairro $fkBairroId): self
    {
        $this->fkBairroId = $fkBairroId;

        return $this;
    }

    public function getCliente(): ?bool
    {
        return $this->cliente;
    }

    public function setCliente(bool $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getAdministrador(): ?bool
    {
        return $this->administrador;
    }

    public function setAdministrador(bool $administrador): self
    {
        $this->administrador = $administrador;

        return $this;
    }
}
