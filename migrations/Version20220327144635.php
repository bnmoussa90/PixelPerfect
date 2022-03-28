<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220327144635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statu (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tiket (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, satatu_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_873E079DA76ED395 (user_id), INDEX IDX_873E079D215A69DF (satatu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tiket_detail (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, tiket_id INT DEFAULT NULL, reponse VARCHAR(255) NOT NULL, INDEX IDX_2AB03731A76ED395 (user_id), INDEX IDX_2AB037311DAA6578 (tiket_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tiket ADD CONSTRAINT FK_873E079DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tiket ADD CONSTRAINT FK_873E079D215A69DF FOREIGN KEY (satatu_id) REFERENCES statu (id)');
        $this->addSql('ALTER TABLE tiket_detail ADD CONSTRAINT FK_2AB03731A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tiket_detail ADD CONSTRAINT FK_2AB037311DAA6578 FOREIGN KEY (tiket_id) REFERENCES tiket (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tiket DROP FOREIGN KEY FK_873E079D215A69DF');
        $this->addSql('ALTER TABLE tiket_detail DROP FOREIGN KEY FK_2AB037311DAA6578');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE tiket DROP FOREIGN KEY FK_873E079DA76ED395');
        $this->addSql('ALTER TABLE tiket_detail DROP FOREIGN KEY FK_2AB03731A76ED395');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE statu');
        $this->addSql('DROP TABLE tiket');
        $this->addSql('DROP TABLE tiket_detail');
        $this->addSql('DROP TABLE user');
    }
}
