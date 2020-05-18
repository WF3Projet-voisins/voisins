<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200518185907 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ranking (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, count INT NOT NULL, logo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE rankUser');
        $this->addSql('DROP INDEX IDX_8D93D6497616678F ON user');
        $this->addSql('ALTER TABLE user CHANGE image image VARCHAR(255) NOT NULL, CHANGE rankuser_id ranking_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64920F64684 FOREIGN KEY (ranking_id) REFERENCES ranking (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64920F64684 ON user (ranking_id)');
        $this->addSql('ALTER TABLE user_category ADD CONSTRAINT FK_E6C1FDC1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_category ADD CONSTRAINT FK_E6C1FDC112469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_sub_category ADD CONSTRAINT FK_3C2F8B9AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_sub_category ADD CONSTRAINT FK_3C2F8B9AF7BFE87C FOREIGN KEY (sub_category_id) REFERENCES sub_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C20C3C701 FOREIGN KEY (user_from_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE mailbox CHANGE message_title message_title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE mailbox ADD CONSTRAINT FK_A69FE20B20C3C701 FOREIGN KEY (user_from_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mailbox ADD CONSTRAINT FK_A69FE20B4969C270 FOREIGN KEY (user_for_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F79812469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64920F64684');
        $this->addSql('CREATE TABLE rankUser (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, count INT NOT NULL, logo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE ranking');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C20C3C701');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CED5CA9E6');
        $this->addSql('ALTER TABLE mailbox DROP FOREIGN KEY FK_A69FE20B20C3C701');
        $this->addSql('ALTER TABLE mailbox DROP FOREIGN KEY FK_A69FE20B4969C270');
        $this->addSql('ALTER TABLE mailbox CHANGE message_title message_title VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE sub_category DROP FOREIGN KEY FK_BCE3F79812469DE2');
        $this->addSql('DROP INDEX IDX_8D93D64920F64684 ON user');
        $this->addSql('ALTER TABLE user CHANGE image image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ranking_id rankUser_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_8D93D6497616678F ON user (rankUser_id)');
        $this->addSql('ALTER TABLE user_category DROP FOREIGN KEY FK_E6C1FDC1A76ED395');
        $this->addSql('ALTER TABLE user_category DROP FOREIGN KEY FK_E6C1FDC112469DE2');
        $this->addSql('ALTER TABLE user_sub_category DROP FOREIGN KEY FK_3C2F8B9AA76ED395');
        $this->addSql('ALTER TABLE user_sub_category DROP FOREIGN KEY FK_3C2F8B9AF7BFE87C');
    }
}
