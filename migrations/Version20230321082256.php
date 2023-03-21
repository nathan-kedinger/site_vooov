<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230321082256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE audio_records DROP FOREIGN KEY FK_A32A519A1F48AE04');
        $this->addSql('DROP INDEX IDX_A32A519A1F48AE04 ON audio_records');
        $this->addSql('ALTER TABLE audio_records CHANGE artist_id_id artist_id INT NOT NULL');
        $this->addSql('ALTER TABLE audio_records ADD CONSTRAINT FK_A32A519AB7970CF8 FOREIGN KEY (artist_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_A32A519AB7970CF8 ON audio_records (artist_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE audio_records DROP FOREIGN KEY FK_A32A519AB7970CF8');
        $this->addSql('DROP INDEX IDX_A32A519AB7970CF8 ON audio_records');
        $this->addSql('ALTER TABLE audio_records CHANGE artist_id artist_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE audio_records ADD CONSTRAINT FK_A32A519A1F48AE04 FOREIGN KEY (artist_id_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_A32A519A1F48AE04 ON audio_records (artist_id_id)');
    }
}
