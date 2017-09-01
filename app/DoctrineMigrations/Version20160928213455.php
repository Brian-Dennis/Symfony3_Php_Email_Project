<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160928213455 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE property_owner (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, phone_numbers LONGTEXT DEFAULT NULL, phone_main VARCHAR(255) DEFAULT NULL, phone_mobile VARCHAR(255) DEFAULT NULL, phone_office VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, properties LONGTEXT DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE property__owner');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE property__owner (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, phone_numbers LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, phone_main VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, phone_mobile VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, phone_office VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, email VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, properties LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, address VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE property_owner');
    }
}
