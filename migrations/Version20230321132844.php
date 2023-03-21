<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230321132844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conversations ADD sender_id INT NOT NULL, ADD receiver_id INT NOT NULL');
        $this->addSql('ALTER TABLE conversations ADD CONSTRAINT FK_C2521BF1F624B39D FOREIGN KEY (sender_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE conversations ADD CONSTRAINT FK_C2521BF1CD53EDB6 FOREIGN KEY (receiver_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_C2521BF1F624B39D ON conversations (sender_id)');
        $this->addSql('CREATE INDEX IDX_C2521BF1CD53EDB6 ON conversations (receiver_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conversations DROP FOREIGN KEY FK_C2521BF1F624B39D');
        $this->addSql('ALTER TABLE conversations DROP FOREIGN KEY FK_C2521BF1CD53EDB6');
        $this->addSql('DROP INDEX IDX_C2521BF1F624B39D ON conversations');
        $this->addSql('DROP INDEX IDX_C2521BF1CD53EDB6 ON conversations');
        $this->addSql('ALTER TABLE conversations DROP sender_id, DROP receiver_id');
    }
}
