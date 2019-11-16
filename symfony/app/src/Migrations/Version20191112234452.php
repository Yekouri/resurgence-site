<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191112234452 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE attunement (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, rank_id INT NOT NULL, user_id INT NOT NULL, name VARCHAR(255) NOT NULL, race VARCHAR(255) NOT NULL, class VARCHAR(255) NOT NULL, spec VARCHAR(255) NOT NULL, pvp TINYINT(1) NOT NULL, current_pvp_rank INT NOT NULL, goal_pvp_rank INT DEFAULT NULL, profession_a VARCHAR(255) DEFAULT NULL, profession_b VARCHAR(255) DEFAULT NULL, join_date DATE DEFAULT NULL, INDEX IDX_8157AA0F7616678F (rank_id), INDEX IDX_8157AA0FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile_attunement (profile_id INT NOT NULL, attunement_id INT NOT NULL, INDEX IDX_69AB8154CCFA12B8 (profile_id), INDEX IDX_69AB8154406B359F (attunement_id), PRIMARY KEY(profile_id, attunement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rank (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F7616678F FOREIGN KEY (rank_id) REFERENCES rank (id)');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE profile_attunement ADD CONSTRAINT FK_69AB8154CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profile_attunement ADD CONSTRAINT FK_69AB8154406B359F FOREIGN KEY (attunement_id) REFERENCES attunement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE profile_attunement DROP FOREIGN KEY FK_69AB8154406B359F');
        $this->addSql('ALTER TABLE profile_attunement DROP FOREIGN KEY FK_69AB8154CCFA12B8');
        $this->addSql('ALTER TABLE profile DROP FOREIGN KEY FK_8157AA0F7616678F');
        $this->addSql('DROP TABLE attunement');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE profile_attunement');
        $this->addSql('DROP TABLE rank');
    }
}
