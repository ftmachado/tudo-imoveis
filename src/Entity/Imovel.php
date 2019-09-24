<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="imovel")
 * @ORM\Entity(repositoryClass="App\Repository\ImovelRepository")
 */
class Imovel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $titulo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoImovel")
     * @ORM\JoinColumn(name="fk_tipo_imovel_id")
     */
    private $fkTipoImovelId;

    /**
     * @ORM\Column(name="tipo_anuncio", type="string", length=15, options={"comment":"alugar|vender"})
     */
    private $tipoAnuncio;

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
     * @ORM\Column(name="area_total", type="integer", nullable=true)
     */
    private $areaTotal;

    /**
     * @ORM\Column(name="area_util", type="integer", nullable=true)
     */
    private $areaUtil;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $garagem;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quarto;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $banheiro;

    /**
     * @ORM\Column(name="exposicao_solar", type="string", length=15, nullable=true)
     */
    private $exposicaoSolar;

    /**
     * @ORM\Column(name="posicao_predio", type="integer", nullable=true, options={"comment":"1,2,3,4,5,6,7,8,9 de acordo com imagem de cubo"})
     */
    private $posicaoPredio;

    /**
     * @ORM\Column(type="string", length=45, nullable=true, options={"comment":"disponivel|vendido|alugado|cancelado"})
     */
    private $status;

    /**
     * @ORM\Column(name="status_data", type="datetime", nullable=true)
     */
    private $statusData;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descricao;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pessoa")
     * @ORM\JoinColumn(name="fk_proprietario_id")
     */
    private $fkProprietarioId;

    /**
     * @ORM\Column(name="valor_proprietario", type="float", nullable=true)
     */
    private $valorProprietario;

    /**
     * @ORM\Column(name="valor_condominio", type="float", nullable=true)
     */
    private $valorCondominio;

    /**
     * @ORM\Column(name="valor_iptu", type="float", nullable=true)
     */
    private $valorIptu;

    /**
     * @ORM\Column(name="valor_imobiliaria", type="float", nullable=true)
     */
    private $valorImobiliaria;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(?string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getFkTipoImovelId(): ?TipoImovel
    {
        return $this->fkTipoImovelId;
    }

    public function setFkTipoImovelId(?TipoImovel $fkTipoImovelId): self
    {
        $this->fkTipoImovelId = $fkTipoImovelId;

        return $this;
    }

    public function getTipoAnuncio(): ?String
    {
        return $this->tipoAnuncio;
    }

    public function setTipoAnuncio(String $tipoAnuncio): self
    {
        $this->tipoAnuncio = $tipoAnuncio;

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

    public function getAreaTotal(): ?int
    {
        return $this->areaTotal;
    }

    public function setAreaTotal(?int $areaTotal): self
    {
        $this->areaTotal = $areaTotal;

        return $this;
    }

    public function getAreaUtil(): ?int
    {
        return $this->areaUtil;
    }

    public function setAreaUtil(?int $areaUtil): self
    {
        $this->areaUtil = $areaUtil;

        return $this;
    }

    public function getGaragem(): ?int
    {
        return $this->garagem;
    }

    public function setGaragem(?int $garagem): self
    {
        $this->garagem = $garagem;

        return $this;
    }

    public function getQuarto(): ?int
    {
        return $this->quarto;
    }

    public function setQuarto(?int $quarto): self
    {
        $this->quarto = $quarto;

        return $this;
    }

    public function getBanheiro(): ?int
    {
        return $this->banheiro;
    }

    public function setBanheiro(?int $banheiro): self
    {
        $this->banheiro = $banheiro;

        return $this;
    }

    public function getExposicaoSolar(): ?string
    {
        return $this->exposicaoSolar;
    }

    public function setExposicaoSolar(?string $exposicaoSolar): self
    {
        $this->exposicaoSolar = $exposicaoSolar;

        return $this;
    }

    public function getPosicaoPredio(): ?int
    {
        return $this->posicaoPredio;
    }

    public function setPosicaoPredio(?int $posicaoPredio): self
    {
        $this->posicaoPredio = $posicaoPredio;

        return $this;
    }

    public function getStatus(): ?String
    {
        return $this->status;
    }

    public function setStatus(?String $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStatusData(): ?\DateTimeInterface
    {
        return $this->statusData;
    }

    public function setStatusData(?\DateTimeInterface $statusData): self
    {
        $this->statusData = $statusData;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getFkProprietarioId(): ?Pessoa
    {
        return $this->fkProprietarioId;
    }

    public function setFkProprietarioId(?Pessoa $fkProprietarioId): self
    {
        $this->fkProprietarioId = $fkProprietarioId;

        return $this;
    }

    public function getValorProprietario(): ?float
    {
        return $this->valorProprietario;
    }

    public function setValorProprietario(?float $valorProprietario): self
    {
        $this->valorProprietario = $valorProprietario;

        return $this;
    }

    public function getValorCondominio(): ?float
    {
        return $this->valorCondominio;
    }

    public function setValorCondominio(?float $valorCondominio): self
    {
        $this->valorCondominio = $valorCondominio;

        return $this;
    }

    public function getValorIptu(): ?float
    {
        return $this->valorIptu;
    }

    public function setValorIptu(?float $valorIptu): self
    {
        $this->valorIptu = $valorIptu;

        return $this;
    }

    public function getValorImobiliaria(): ?float
    {
        return $this->valorImobiliaria;
    }

    public function setValorImobiliaria(?float $valorImobiliaria): self
    {
        $this->valorImobiliaria = $valorImobiliaria;

        return $this;
    }
}
