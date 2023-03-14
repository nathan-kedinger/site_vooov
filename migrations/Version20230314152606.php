<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230314152606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE audio_records ADD kind_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE audio_records ADD CONSTRAINT FK_A32A519A30602CA9 FOREIGN KEY (kind_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_A32A519A30602CA9 ON audio_records (kind_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE audio_records DROP FOREIGN KEY FK_A32A519A30602CA9');
        $this->addSql('DROP INDEX IDX_A32A519A30602CA9 ON audio_records');
        $this->addSql('ALTER TABLE audio_records DROP kind_id');
    }
}
