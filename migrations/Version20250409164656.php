<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250409164656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prix NUMERIC(10, 2) DEFAULT 0 NOT NULL, description CLOB DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, categorie_id INTEGER DEFAULT NULL, CONSTRAINT FK_23A0E66BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_23A0E66BCF5E72D ON article (categorie_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE categorie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(50) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE client (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, contact VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vente (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, reference VARCHAR(50) NOT NULL, date DATE NOT NULL, create_at DATETIME DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vente_article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, prix NUMERIC(10, 2) DEFAULT 0 NOT NULL, quantite NUMERIC(10, 2) DEFAULT 0 NOT NULL, montant NUMERIC(10, 2) DEFAULT 0 NOT NULL, vente_id INTEGER DEFAULT NULL, article_id INTEGER DEFAULT NULL, CONSTRAINT FK_5D3092867DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5D3092867294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5D3092867DC7170A ON vente_article (vente_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5D3092867294869C ON vente_article (article_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__symfony_demo_user AS SELECT id, full_name, username, email, password, roles, firstname, lastname, is_verified FROM symfony_demo_user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE symfony_demo_user
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE symfony_demo_user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles CLOB NOT NULL, firstname VARCHAR(50) DEFAULT NULL, lastname VARCHAR(50) DEFAULT NULL, is_verified BOOLEAN DEFAULT 1 NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO symfony_demo_user (id, full_name, username, email, password, roles, firstname, lastname, is_verified) SELECT id, full_name, username, email, password, roles, firstname, lastname, is_verified FROM __temp__symfony_demo_user
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

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE article
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE categorie
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE client
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vente
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vente_article
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__symfony_demo_user AS SELECT id, full_name, username, email, password, roles, firstname, lastname, is_verified FROM symfony_demo_user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE symfony_demo_user
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE symfony_demo_user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles CLOB NOT NULL, firstname VARCHAR(50) DEFAULT NULL, lastname VARCHAR(50) DEFAULT NULL, is_verified BOOLEAN DEFAULT 0 NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO symfony_demo_user (id, full_name, username, email, password, roles, firstname, lastname, is_verified) SELECT id, full_name, username, email, password, roles, firstname, lastname, is_verified FROM __temp__symfony_demo_user
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
