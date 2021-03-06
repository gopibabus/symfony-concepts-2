<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210109231704 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Added specific location name field to Article Entity';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE article ADD specific_location_name VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE article DROP specific_location_name');
    }
}
