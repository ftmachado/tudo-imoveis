<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191004195740 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bairro ADD fk_estado_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bairro ADD CONSTRAINT FK_81F33205FE03939B FOREIGN KEY (fk_estado_id) REFERENCES estado (id)');
        $this->addSql('CREATE INDEX IDX_81F33205FE03939B ON bairro (fk_estado_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bairro DROP FOREIGN KEY FK_81F33205FE03939B');
        $this->addSql('DROP INDEX IDX_81F33205FE03939B ON bairro');
        $this->addSql('ALTER TABLE bairro DROP fk_estado_id');
    }
}
