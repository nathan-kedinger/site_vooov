<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308172529 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE audio_records (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', artist_uuid VARCHAR(36) NOT NULL, title VARCHAR(255) NOT NULL, length INT NOT NULL, number_of_plays INT NOT NULL, number_of_moons INT NOT NULL, voice_style VARCHAR(255) NOT NULL, kind VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at VARCHAR(255) NOT NULL, updated_at VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conversations (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', sender VARCHAR(36) NOT NULL, receiver VARCHAR(36) NOT NULL, title VARCHAR(255) NOT NULL, created_at VARCHAR(255) NOT NULL, updated_at VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE friends (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user1 VARCHAR(36) NOT NULL, user2 VARCHAR(36) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', conversation_uuid VARCHAR(36) NOT NULL, sender VARCHAR(36) NOT NULL, receiver VARCHAR(36) NOT NULL, body LONGTEXT NOT NULL, seen TINYINT(1) NOT NULL, send_at VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pictures (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_uuid VARCHAR(36) NOT NULL, url VARCHAR(255) NOT NULL, format VARCHAR(5) NOT NULL, size INT NOT NULL, upload_at VARCHAR(255) NOT NULL, validated TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', pseudo VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, birthday VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, number_of_followers INT NOT NULL, number_of_moons INT NOT NULL, number_of_friends INT NOT NULL, url_profile_picture VARCHAR(255) NOT NULL, sign_in VARCHAR(255) NOT NULL, last_connection VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE audio_records');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE conversations');
        $this->addSql('DROP TABLE friends');
        $this->addSql('DROP TABLE messages');
        $this->addSql('DROP TABLE pictures');
        $this->addSql('DROP TABLE users');
    }
}
