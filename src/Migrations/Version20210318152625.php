<?php

declare(strict_types=1);

namespace HansPeterOrding\NflFastrSymfonyBundle\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210318152625 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE drive ALTER start_yard_line TYPE VARCHAR(30)');
        $this->addSql('ALTER TABLE drive ALTER start_yard_line DROP DEFAULT');
        $this->addSql('ALTER TABLE drive ALTER end_yard_line TYPE VARCHAR(30)');
        $this->addSql('ALTER TABLE drive ALTER end_yard_line DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE drive ALTER start_yard_line TYPE INT');
        $this->addSql('ALTER TABLE drive ALTER start_yard_line DROP DEFAULT');
        $this->addSql('ALTER TABLE drive ALTER start_yard_line TYPE INT');
        $this->addSql('ALTER TABLE drive ALTER end_yard_line TYPE INT');
        $this->addSql('ALTER TABLE drive ALTER end_yard_line DROP DEFAULT');
        $this->addSql('ALTER TABLE drive ALTER end_yard_line TYPE INT');
    }
}
