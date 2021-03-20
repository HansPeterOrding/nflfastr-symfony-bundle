<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210317164639 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE drive ADD game_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE drive ADD CONSTRAINT FK_681DF58FE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_681DF58FE48FD905 ON drive (game_id)');
        $this->addSql('ALTER TABLE play DROP yard_line');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE play ADD yard_line INT NOT NULL');
        $this->addSql('ALTER TABLE drive DROP CONSTRAINT FK_681DF58FE48FD905');
        $this->addSql('DROP INDEX IDX_681DF58FE48FD905');
        $this->addSql('ALTER TABLE drive DROP game_id');
    }
}
