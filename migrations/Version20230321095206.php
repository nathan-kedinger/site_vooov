<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230321095206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE audio_record_categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE audio_records (id INT AUTO_INCREMENT NOT NULL, artist_id INT NOT NULL, categories_id INT DEFAULT NULL, voice_style_id INT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', title VARCHAR(255) NOT NULL, length INT NOT NULL, number_of_plays INT NOT NULL, number_of_moons INT NOT NULL, description LONGTEXT NOT NULL, created_at VARCHAR(255) NOT NULL, updated_at VARCHAR(255) NOT NULL, INDEX IDX_A32A519AB7970CF8 (artist_id), INDEX IDX_A32A519AA21214B7 (categories_id), INDEX IDX_A32A519AD392D671 (voice_style_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conversations (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', sender VARCHAR(36) NOT NULL, receiver VARCHAR(36) NOT NULL, title VARCHAR(255) NOT NULL, created_at VARCHAR(255) NOT NULL, updated_at VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE friends (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user1 VARCHAR(36) NOT NULL, user2 VARCHAR(36) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', conversation_uuid VARCHAR(36) NOT NULL, sender VARCHAR(36) NOT NULL, receiver VARCHAR(36) NOT NULL, body LONGTEXT NOT NULL, seen TINYINT(1) NOT NULL, send_at VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offers (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, voice_style_id INT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', title VARCHAR(255) NOT NULL, body LONGTEXT NOT NULL, budget INT NOT NULL, accomplished TINYINT(1) NOT NULL, created_at VARCHAR(255) NOT NULL, end_at DATETIME NOT NULL, INDEX IDX_DA4604279D86650F (user_id_id), INDEX IDX_DA460427D392D671 (voice_style_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pictures (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_uuid VARCHAR(36) NOT NULL, url VARCHAR(255) NOT NULL, format VARCHAR(5) NOT NULL, size INT NOT NULL, upload_at VARCHAR(255) NOT NULL, validated TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', pseudo VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, birthday VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, number_of_followers INT NOT NULL, number_of_moons INT NOT NULL, number_of_friends INT NOT NULL, url_profile_picture VARCHAR(255) NOT NULL, sign_in VARCHAR(255) NOT NULL, last_connection VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voice_style (id INT AUTO_INCREMENT NOT NULL, voice_style VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE audio_records ADD CONSTRAINT FK_A32A519AB7970CF8 FOREIGN KEY (artist_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE audio_records ADD CONSTRAINT FK_A32A519AA21214B7 FOREIGN KEY (categories_id) REFERENCES audio_record_categories (id)');
        $this->addSql('ALTER TABLE audio_records ADD CONSTRAINT FK_A32A519AD392D671 FOREIGN KEY (voice_style_id) REFERENCES voice_style (id)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA4604279D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE offers ADD CONSTRAINT FK_DA460427D392D671 FOREIGN KEY (voice_style_id) REFERENCES voice_style (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE audio_records DROP FOREIGN KEY FK_A32A519AB7970CF8');
        $this->addSql('ALTER TABLE audio_records DROP FOREIGN KEY FK_A32A519AA21214B7');
        $this->addSql('ALTER TABLE audio_records DROP FOREIGN KEY FK_A32A519AD392D671');
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA4604279D86650F');
        $this->addSql('ALTER TABLE offers DROP FOREIGN KEY FK_DA460427D392D671');
        $this->addSql('DROP TABLE audio_record_categories');
        $this->addSql('DROP TABLE audio_records');
        $this->addSql('DROP TABLE conversations');
        $this->addSql('DROP TABLE friends');
        $this->addSql('DROP TABLE messages');
        $this->addSql('DROP TABLE offers');
        $this->addSql('DROP TABLE pictures');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE voice_style');
    }
}
