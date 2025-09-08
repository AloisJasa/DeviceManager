<?php declare(strict_types = 1);

namespace AloisJasa\DeviceManager\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250908095348 extends AbstractMigration
{
	public function getDescription(): string
	{
		return '';
	}


	public function up(Schema $schema): void
	{
		// this up() migration is auto-generated, please modify it to your needs
		$this->addSql('CREATE TABLE device_manager_device (id VARCHAR(255) NOT NULL, owner_id VARCHAR(255) NOT NULL, hostname VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, os VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
		$this->addSql('CREATE INDEX IDX_6947410C7E3C61F9 ON device_manager_device (owner_id)');
		$this->addSql('CREATE TABLE device_manager_user (id VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
		$this->addSql('ALTER TABLE device_manager_device ADD CONSTRAINT FK_6947410C7E3C61F9 FOREIGN KEY (owner_id) REFERENCES device_manager_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
	}


	public function down(Schema $schema): void
	{
		// this down() migration is auto-generated, please modify it to your needs
		$this->addSql('CREATE SCHEMA public');
		$this->addSql('ALTER TABLE device_manager_device DROP CONSTRAINT FK_6947410C7E3C61F9');
		$this->addSql('DROP TABLE device_manager_device');
		$this->addSql('DROP TABLE device_manager_user');
	}
}
