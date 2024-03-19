<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240308163830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agency ADD monday_opening TIME DEFAULT NULL, ADD monday_closing TIME DEFAULT NULL, ADD tuesday_opening TIME DEFAULT NULL, ADD tuesday_closing TIME DEFAULT NULL, ADD wednesday_opening TIME DEFAULT NULL, ADD wednesday_closing TIME DEFAULT NULL, ADD thursday_opening TIME DEFAULT NULL, ADD thursday_closing TIME DEFAULT NULL, ADD friday_opening TIME DEFAULT NULL, ADD friday_closing TIME DEFAULT NULL, ADD saturday_opening TIME DEFAULT NULL, ADD saturday_closing TIME DEFAULT NULL, ADD sunday_opening TIME DEFAULT NULL, ADD sunday_closing TIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agency DROP monday_opening, DROP monday_closing, DROP tuesday_opening, DROP tuesday_closing, DROP wednesday_opening, DROP wednesday_closing, DROP thursday_opening, DROP thursday_closing, DROP friday_opening, DROP friday_closing, DROP saturday_opening, DROP saturday_closing, DROP sunday_opening, DROP sunday_closing');
    }
}
