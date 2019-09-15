<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190915143357 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bairro (id INT AUTO_INCREMENT NOT NULL, fk_cidade_id INT DEFAULT NULL, nome VARCHAR(255) DEFAULT NULL, INDEX IDX_81F332056801BB58 (fk_cidade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cidade (id INT AUTO_INCREMENT NOT NULL, fk_estado_id INT DEFAULT NULL, nome VARCHAR(255) DEFAULT NULL, INDEX IDX_6A98335CFE03939B (fk_estado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estado (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, sigla VARCHAR(5) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE imobiliaria (id INT AUTO_INCREMENT NOT NULL, cnpj VARCHAR(15) NOT NULL, nome_fantasia VARCHAR(255) DEFAULT NULL, telefone VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE imobiliaria_atuacao (id INT AUTO_INCREMENT NOT NULL, fk_imobiliaria_id INT DEFAULT NULL, fk_estado_id INT DEFAULT NULL, fk_cidade_id INT DEFAULT NULL, INDEX IDX_70D6AD5F200D129E (fk_imobiliaria_id), INDEX IDX_70D6AD5FFE03939B (fk_estado_id), INDEX IDX_70D6AD5F6801BB58 (fk_cidade_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE imovel (id INT AUTO_INCREMENT NOT NULL, fk_tipo_imovel_id INT DEFAULT NULL, fk_estado_id INT DEFAULT NULL, fk_cidade_id INT DEFAULT NULL, fk_bairro_id INT DEFAULT NULL, fk_proprietario_id INT DEFAULT NULL, titulo VARCHAR(45) DEFAULT NULL, tipo_anuncio VARCHAR(15) NOT NULL COMMENT \'alugar|vender\', endereco VARCHAR(255) DEFAULT NULL, numero INT DEFAULT NULL, cep VARCHAR(15) DEFAULT NULL, complemento VARCHAR(45) DEFAULT NULL, area_total INT DEFAULT NULL, area_util INT DEFAULT NULL, garagem INT DEFAULT NULL, quarto INT DEFAULT NULL, banheiro INT DEFAULT NULL, exposicao_solar VARCHAR(15) DEFAULT NULL, posicao_predio INT DEFAULT NULL COMMENT \'1,2,3,4,5,6,7,8,9 de acordo com imagem de cubo\', status VARCHAR(45) DEFAULT NULL COMMENT \'disponivel|vendido|alugado|cancelado\', status_data DATETIME DEFAULT NULL, descricao LONGTEXT DEFAULT NULL, valor_proprietario DOUBLE PRECISION DEFAULT NULL, valor_condominio DOUBLE PRECISION DEFAULT NULL, valor_iptu DOUBLE PRECISION DEFAULT NULL, valor_imobiliaria DOUBLE PRECISION DEFAULT NULL, INDEX IDX_902C0DEBD3E0BEE8 (fk_tipo_imovel_id), INDEX IDX_902C0DEBFE03939B (fk_estado_id), INDEX IDX_902C0DEB6801BB58 (fk_cidade_id), INDEX IDX_902C0DEBC817271D (fk_bairro_id), INDEX IDX_902C0DEBBEFAEED0 (fk_proprietario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pessoa (id INT AUTO_INCREMENT NOT NULL, fk_estado_id INT DEFAULT NULL, fk_cidade_id INT DEFAULT NULL, fk_bairro_id INT DEFAULT NULL, cpf VARCHAR(11) NOT NULL, rg VARCHAR(15) DEFAULT NULL, nome VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, telefone_principal VARCHAR(15) DEFAULT NULL, telefone_secundario VARCHAR(15) DEFAULT NULL, usuario VARCHAR(45) DEFAULT NULL, senha VARCHAR(45) DEFAULT NULL, endereco VARCHAR(255) DEFAULT NULL, numero INT DEFAULT NULL, cep VARCHAR(15) DEFAULT NULL, complemento VARCHAR(45) DEFAULT NULL, cliente TINYINT(1) DEFAULT \'1\' NOT NULL COMMENT \'1=Sim, 0=Não\', administrador TINYINT(1) DEFAULT \'0\' NOT NULL COMMENT \'1=Sim, 0=Não\', INDEX IDX_1CDFAB82FE03939B (fk_estado_id), INDEX IDX_1CDFAB826801BB58 (fk_cidade_id), INDEX IDX_1CDFAB82C817271D (fk_bairro_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo_imovel (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bairro ADD CONSTRAINT FK_81F332056801BB58 FOREIGN KEY (fk_cidade_id) REFERENCES cidade (id)');
        $this->addSql('ALTER TABLE cidade ADD CONSTRAINT FK_6A98335CFE03939B FOREIGN KEY (fk_estado_id) REFERENCES estado (id)');
        $this->addSql('ALTER TABLE imobiliaria_atuacao ADD CONSTRAINT FK_70D6AD5F200D129E FOREIGN KEY (fk_imobiliaria_id) REFERENCES imobiliaria (id)');
        $this->addSql('ALTER TABLE imobiliaria_atuacao ADD CONSTRAINT FK_70D6AD5FFE03939B FOREIGN KEY (fk_estado_id) REFERENCES estado (id)');
        $this->addSql('ALTER TABLE imobiliaria_atuacao ADD CONSTRAINT FK_70D6AD5F6801BB58 FOREIGN KEY (fk_cidade_id) REFERENCES cidade (id)');
        $this->addSql('ALTER TABLE imovel ADD CONSTRAINT FK_902C0DEBD3E0BEE8 FOREIGN KEY (fk_tipo_imovel_id) REFERENCES tipo_imovel (id)');
        $this->addSql('ALTER TABLE imovel ADD CONSTRAINT FK_902C0DEBFE03939B FOREIGN KEY (fk_estado_id) REFERENCES estado (id)');
        $this->addSql('ALTER TABLE imovel ADD CONSTRAINT FK_902C0DEB6801BB58 FOREIGN KEY (fk_cidade_id) REFERENCES cidade (id)');
        $this->addSql('ALTER TABLE imovel ADD CONSTRAINT FK_902C0DEBC817271D FOREIGN KEY (fk_bairro_id) REFERENCES bairro (id)');
        $this->addSql('ALTER TABLE imovel ADD CONSTRAINT FK_902C0DEBBEFAEED0 FOREIGN KEY (fk_proprietario_id) REFERENCES pessoa (id)');
        $this->addSql('ALTER TABLE pessoa ADD CONSTRAINT FK_1CDFAB82FE03939B FOREIGN KEY (fk_estado_id) REFERENCES estado (id)');
        $this->addSql('ALTER TABLE pessoa ADD CONSTRAINT FK_1CDFAB826801BB58 FOREIGN KEY (fk_cidade_id) REFERENCES cidade (id)');
        $this->addSql('ALTER TABLE pessoa ADD CONSTRAINT FK_1CDFAB82C817271D FOREIGN KEY (fk_bairro_id) REFERENCES bairro (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE imovel DROP FOREIGN KEY FK_902C0DEBC817271D');
        $this->addSql('ALTER TABLE pessoa DROP FOREIGN KEY FK_1CDFAB82C817271D');
        $this->addSql('ALTER TABLE bairro DROP FOREIGN KEY FK_81F332056801BB58');
        $this->addSql('ALTER TABLE imobiliaria_atuacao DROP FOREIGN KEY FK_70D6AD5F6801BB58');
        $this->addSql('ALTER TABLE imovel DROP FOREIGN KEY FK_902C0DEB6801BB58');
        $this->addSql('ALTER TABLE pessoa DROP FOREIGN KEY FK_1CDFAB826801BB58');
        $this->addSql('ALTER TABLE cidade DROP FOREIGN KEY FK_6A98335CFE03939B');
        $this->addSql('ALTER TABLE imobiliaria_atuacao DROP FOREIGN KEY FK_70D6AD5FFE03939B');
        $this->addSql('ALTER TABLE imovel DROP FOREIGN KEY FK_902C0DEBFE03939B');
        $this->addSql('ALTER TABLE pessoa DROP FOREIGN KEY FK_1CDFAB82FE03939B');
        $this->addSql('ALTER TABLE imobiliaria_atuacao DROP FOREIGN KEY FK_70D6AD5F200D129E');
        $this->addSql('ALTER TABLE imovel DROP FOREIGN KEY FK_902C0DEBBEFAEED0');
        $this->addSql('ALTER TABLE imovel DROP FOREIGN KEY FK_902C0DEBD3E0BEE8');
        $this->addSql('DROP TABLE bairro');
        $this->addSql('DROP TABLE cidade');
        $this->addSql('DROP TABLE estado');
        $this->addSql('DROP TABLE imobiliaria');
        $this->addSql('DROP TABLE imobiliaria_atuacao');
        $this->addSql('DROP TABLE imovel');
        $this->addSql('DROP TABLE pessoa');
        $this->addSql('DROP TABLE tipo_imovel');
    }
}
