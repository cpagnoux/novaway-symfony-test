<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181018032314 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE actor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, FULLTEXT INDEX IDX_447556F95E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bluray (id INT AUTO_INCREMENT NOT NULL, director_id INT NOT NULL, isan VARCHAR(33) NOT NULL, title VARCHAR(50) NOT NULL, release_date DATETIME NOT NULL, duration INT DEFAULT NULL, storyline LONGTEXT DEFAULT NULL, price NUMERIC(5, 2) DEFAULT NULL, INDEX IDX_F697EA50899FB366 (director_id), FULLTEXT INDEX IDX_F697EA50E731A7252B36786B (isan, title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bluray_actor (bluray_id INT NOT NULL, actor_id INT NOT NULL, INDEX IDX_3179BB93C007F6F7 (bluray_id), INDEX IDX_3179BB9310DAF24A (actor_id), PRIMARY KEY(bluray_id, actor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, FULLTEXT INDEX IDX_BDAFD8C85E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dvd (id INT AUTO_INCREMENT NOT NULL, director_id INT NOT NULL, isan VARCHAR(33) NOT NULL, title VARCHAR(50) NOT NULL, release_date DATETIME NOT NULL, duration INT DEFAULT NULL, storyline LONGTEXT DEFAULT NULL, price NUMERIC(5, 2) DEFAULT NULL, INDEX IDX_8325C1DF899FB366 (director_id), FULLTEXT INDEX IDX_8325C1DFE731A7252B36786B (isan, title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dvd_actor (dvd_id INT NOT NULL, actor_id INT NOT NULL, INDEX IDX_8DCF2F21797185F6 (dvd_id), INDEX IDX_8DCF2F2110DAF24A (actor_id), PRIMARY KEY(dvd_id, actor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, isbn VARCHAR(17) NOT NULL, title VARCHAR(50) NOT NULL, release_date DATETIME NOT NULL, num_pages INT DEFAULT NULL, summary LONGTEXT DEFAULT NULL, price NUMERIC(5, 2) DEFAULT NULL, INDEX IDX_CBE5A331F675F31B (author_id), FULLTEXT INDEX IDX_CBE5A331CC1CF4E62B36786B (isbn, title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE director (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, FULLTEXT INDEX IDX_1E90D3F05E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bluray ADD CONSTRAINT FK_F697EA50899FB366 FOREIGN KEY (director_id) REFERENCES director (id)');
        $this->addSql('ALTER TABLE bluray_actor ADD CONSTRAINT FK_3179BB93C007F6F7 FOREIGN KEY (bluray_id) REFERENCES bluray (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bluray_actor ADD CONSTRAINT FK_3179BB9310DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dvd ADD CONSTRAINT FK_8325C1DF899FB366 FOREIGN KEY (director_id) REFERENCES director (id)');
        $this->addSql('ALTER TABLE dvd_actor ADD CONSTRAINT FK_8DCF2F21797185F6 FOREIGN KEY (dvd_id) REFERENCES dvd (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dvd_actor ADD CONSTRAINT FK_8DCF2F2110DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331F675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bluray_actor DROP FOREIGN KEY FK_3179BB9310DAF24A');
        $this->addSql('ALTER TABLE dvd_actor DROP FOREIGN KEY FK_8DCF2F2110DAF24A');
        $this->addSql('ALTER TABLE bluray_actor DROP FOREIGN KEY FK_3179BB93C007F6F7');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331F675F31B');
        $this->addSql('ALTER TABLE dvd_actor DROP FOREIGN KEY FK_8DCF2F21797185F6');
        $this->addSql('ALTER TABLE bluray DROP FOREIGN KEY FK_F697EA50899FB366');
        $this->addSql('ALTER TABLE dvd DROP FOREIGN KEY FK_8325C1DF899FB366');
        $this->addSql('DROP TABLE actor');
        $this->addSql('DROP TABLE bluray');
        $this->addSql('DROP TABLE bluray_actor');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE dvd');
        $this->addSql('DROP TABLE dvd_actor');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE director');
    }
}
