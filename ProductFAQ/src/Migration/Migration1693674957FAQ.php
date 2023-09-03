<?php declare(strict_types=1);

namespace ProductFAQ\Migration;

use Doctrine\DBAL\Connection;
use Shopware\Core\Framework\Migration\MigrationStep;
use Shopware\Core\Framework\Migration\InheritanceUpdaterTrait;

class Migration1693674957FAQ extends MigrationStep
{
    use InheritanceUpdaterTrait;
    
    public function getCreationTimestamp(): int
    {
        return 1693674957;
    }

    public function update(Connection $connection): void
    {
        // implement update
        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `n_faq` (
                `id` BINARY(16) NOT NULL,
                `type` BINARY(16) NOT NULL,
                `question` VARCHAR(255) NOT NULL,
                `answer` VARCHAR(255) NOT NULL,
                PRIMARY KEY (`id`)
            ) 
            ENGINE=InnoDB 
            DEFAULT CHARSET=utf8mb4 
            COLLATE=utf8mb4_unicode_ci;
        ');
        $connection->executeUpdate('
            CREATE TABLE IF NOT EXISTS `n_faq_relation` (
                `id` BINARY(16) NOT NULL AUTO_INCREMENT,
                `product_id` BINARY(16) NOT NULL,
                `product_version_id` BINARY(16) NOT NULL,
                `faq_id` BINARY(16) NOT NULL,
                PRIMARY KEY (`faq_id`, `product_id`, `product_version_id`),
                CONSTRAINT `fk.n_faq_relation.faq_id` FOREIGN KEY (`faq_id`)
                    REFERENCES `n_faq` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk.n_faq_relation.product_id__product_version_id` FOREIGN KEY (`product_id`, `product_version_id`)
                    REFERENCES `product` (`id`, `version_id`) ON DELETE CASCADE ON UPDATE CASCADE
            )
            ENGINE=InnoDB 
            DEFAULT CHARSET=utf8mb4 
            COLLATE=utf8mb4_unicode_ci;
        ');

        $this->updateInheritance($connection, 'product', 'n_faqs');

    }

    public function updateDestructive(Connection $connection): void
    {
        // implement update destructive
    }
}
