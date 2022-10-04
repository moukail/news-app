<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221001111314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE feed_items (id VARCHAR(255) NOT NULL, feed_id INT NOT NULL, title VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, article LONGTEXT NOT NULL, INDEX IDX_1491BAF151A5BC03 (feed_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feeds (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, language VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE feed_items ADD CONSTRAINT FK_1491BAF151A5BC03 FOREIGN KEY (feed_id) REFERENCES feeds (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feed_items DROP FOREIGN KEY FK_1491BAF151A5BC03');
        $this->addSql('DROP TABLE feed_items');
        $this->addSql('DROP TABLE feeds');
    }
}
