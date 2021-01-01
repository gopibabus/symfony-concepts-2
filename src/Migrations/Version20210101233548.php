<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210101233548 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Created password column in user table';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE user ADD password VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE user DROP password');
    }
}
