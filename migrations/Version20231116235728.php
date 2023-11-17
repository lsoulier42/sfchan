<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116235728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reply DROP CONSTRAINT fk_fda8c6e0f675f31b');
        $this->addSql('DROP INDEX idx_fda8c6e0f675f31b');
        $this->addSql('ALTER TABLE reply ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reply ADD ip_address VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE reply DROP author_id');
        $this->addSql('ALTER TABLE reply ADD CONSTRAINT FK_FDA8C6E0A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_FDA8C6E0A76ED395 ON reply (user_id)');
        $this->addSql('ALTER TABLE thread DROP CONSTRAINT fk_31204c83f675f31b');
        $this->addSql('DROP INDEX idx_31204c83f675f31b');
        $this->addSql('ALTER TABLE thread ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE thread ADD ip_address VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE thread DROP author_id');
        $this->addSql('ALTER TABLE thread ADD CONSTRAINT FK_31204C83A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_31204C83A76ED395 ON thread (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE reply DROP CONSTRAINT FK_FDA8C6E0A76ED395');
        $this->addSql('DROP INDEX IDX_FDA8C6E0A76ED395');
        $this->addSql('ALTER TABLE reply ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE reply DROP user_id');
        $this->addSql('ALTER TABLE reply DROP ip_address');
        $this->addSql('ALTER TABLE reply ADD CONSTRAINT fk_fda8c6e0f675f31b FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_fda8c6e0f675f31b ON reply (author_id)');
        $this->addSql('ALTER TABLE thread DROP CONSTRAINT FK_31204C83A76ED395');
        $this->addSql('DROP INDEX IDX_31204C83A76ED395');
        $this->addSql('ALTER TABLE thread ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE thread DROP user_id');
        $this->addSql('ALTER TABLE thread DROP ip_address');
        $this->addSql('ALTER TABLE thread ADD CONSTRAINT fk_31204c83f675f31b FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_31204c83f675f31b ON thread (author_id)');
    }
}
