<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250407084833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__symfony_demo_user AS SELECT id, full_name, username, email, password, roles FROM symfony_demo_user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE symfony_demo_user
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE symfony_demo_user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles CLOB NOT NULL, firstname VARCHAR(50) DEFAULT NULL, lastname VARCHAR(50) DEFAULT NULL, is_verified BOOLEAN DEFAULT 0 NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO symfony_demo_user (id, full_name, username, email, password, roles) SELECT id, full_name, username, email, password, roles FROM __temp__symfony_demo_user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__symfony_demo_user
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_8FB094A1E7927C74 ON symfony_demo_user (email)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_8FB094A1F85E0677 ON symfony_demo_user (username)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__symfony_demo_user AS SELECT id, full_name, username, email, password, roles FROM symfony_demo_user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE symfony_demo_user
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE symfony_demo_user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
            )
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO symfony_demo_user (id, full_name, username, email, password, roles) SELECT id, full_name, username, email, password, roles FROM __temp__symfony_demo_user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__symfony_demo_user
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_8FB094A1F85E0677 ON symfony_demo_user (username)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_8FB094A1E7927C74 ON symfony_demo_user (email)
        SQL);
    }
}
