<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use SiteContextBundle\Repository\SiteContextRepository;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200302133617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );
        $date = (new \DateTime())->format('Y-m-d H:i:s');
        $this->addSql(
            sprintf(
                'INSERT INTO `site_context` (`host`, `enabled`, `name`, `created_at`, `updated_at`) VALUES(\'%s\', 1, \'%s\', \'%s\', \'%s\')',
                $_ENV['APP_DEFAULT_HOST'],
                SiteContextRepository::ROOT_NAME,
                $date,
                $date
            )
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );
    }
}
