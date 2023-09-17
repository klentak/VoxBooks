<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230915213237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE book ADD isbn INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX isbn_unique_index ON book (isbn)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX isbn_unique_index');
        $this->addSql('ALTER TABLE book DROP isbn');
    }
}
