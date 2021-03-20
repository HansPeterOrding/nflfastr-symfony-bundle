<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210318161731 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE play ALTER seconds_remaining_quarter DROP NOT NULL');
        $this->addSql('ALTER TABLE play ALTER seconds_remaining_half DROP NOT NULL');
        $this->addSql('ALTER TABLE play ALTER seconds_remaining_game DROP NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE play ALTER seconds_remaining_quarter SET NOT NULL');
        $this->addSql('ALTER TABLE play ALTER seconds_remaining_half SET NOT NULL');
        $this->addSql('ALTER TABLE play ALTER seconds_remaining_game SET NOT NULL');
    }
}
