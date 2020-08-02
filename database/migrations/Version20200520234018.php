<?php

namespace Database\Migrations;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Migrations\AbortMigrationException;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20200520234018 extends AbstractMigration
{
    /**
     * @param Schema $schema
     * @throws DBALException
     * @throws AbortMigrationException
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `stocks` (`id` int NOT NULL AUTO_INCREMENT, `product_id` int DEFAULT NULL, `quantity` int NOT NULL, `remanent_quantity` int NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        $this->addSql('CREATE TABLE `products` (`id` int NOT NULL AUTO_INCREMENT, `stock_id` int DEFAULT NULL, `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, `price` double NOT NULL, `taxes` double NOT NULL, `brand_id` INT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        $this->addSql('CREATE TABLE `users` (`id` int NOT NULL AUTO_INCREMENT, `employee_id` int DEFAULT NULL, `customer_id` int DEFAULT NULL, `admin_id` int DEFAULT NULL, `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, `is_active` tinyint(1) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');

        $this->addSql('CREATE TABLE `admins` (`id` int NOT NULL AUTO_INCREMENT, `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        $this->addSql('CREATE TABLE `brands` (`id` int NOT NULL AUTO_INCREMENT,`name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, `description` varchar(255) COLLATE utf8mb4_unicode_ci NULL,PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        $this->addSql('CREATE TABLE `categories` (`id` int NOT NULL AUTO_INCREMENT, `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        $this->addSql('CREATE TABLE `characteristic` (`id` int NOT NULL AUTO_INCREMENT, `product_id` int DEFAULT NULL, `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, `property` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        $this->addSql('CREATE TABLE `customers` (`id` int NOT NULL AUTO_INCREMENT,`uuid` char(36),`email` varchar(255) COLLATE utf8mb4_unicode_ci NULL, `age` int NULL, `cell_phone` varchar(255) COLLATE utf8mb4_unicode_ci NULL, `dni` varchar(255) COLLATE utf8mb4_unicode_ci NULL,`cuil` varchar(255) COLLATE utf8mb4_unicode_ci NULL, `birthday` datetime NULL, `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NULL, `country` varchar(255) COLLATE utf8mb4_unicode_ci NULL, `state` varchar(255) COLLATE utf8mb4_unicode_ci NULL, `city` varchar(255) COLLATE utf8mb4_unicode_ci NULL, `vat_condition` varchar(255) COLLATE utf8mb4_unicode_ci NULL, `gross_income` varchar(255) COLLATE utf8mb4_unicode_ci NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        $this->addSql('CREATE TABLE `employees` (`id` int NOT NULL AUTO_INCREMENT, `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        $this->addSql('CREATE TABLE `filter_options` (`id` int NOT NULL AUTO_INCREMENT, `filter_id` int DEFAULT NULL, `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        $this->addSql('CREATE TABLE `filters` (`id` int NOT NULL AUTO_INCREMENT, `category_id` int DEFAULT NULL, `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        $this->addSql('CREATE TABLE `notifications` (`id` int NOT NULL AUTO_INCREMENT, `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, `notification_read` tinyint(1) NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        $this->addSql('CREATE TABLE `orders` (`id` int NOT NULL AUTO_INCREMENT, `customer_id` int DEFAULT NULL, `employee_id` int DEFAULT NULL, `amount` int NOT NULL, `number_sell` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        $this->addSql('CREATE TABLE `providers` (`id` int NOT NULL AUTO_INCREMENT, `brand_id` int DEFAULT NULL, `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, `business_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NULL, `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci NULL, `address` varchar(255) COLLATE utf8mb4_unicode_ci NULL, `observations` varchar(255) COLLATE utf8mb4_unicode_ci NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        $this->addSql('CREATE TABLE `purchase_orders` (`id` int NOT NULL AUTO_INCREMENT, `provider_id` int DEFAULT NULL, `buyer_user_id` int DEFAULT NULL, `amount` int NOT NULL, `purchase_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        $this->addSql('CREATE TABLE `tokens` (`id` int NOT NULL AUTO_INCREMENT, `user_id` int DEFAULT NULL, `hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');

        $this->addSql('CREATE TABLE `category_product` (`product_id` int NOT NULL, `category_id` int NOT NULL, PRIMARY KEY (`product_id`,`category_id`), KEY `IDX_149244D34584665A` (`product_id`), KEY `IDX_149244D312469DE2` (`category_id`), CONSTRAINT `FK_149244D312469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE, CONSTRAINT `FK_149244D34584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        $this->addSql('CREATE TABLE `order_product` (`product_id` int NOT NULL, `order_id` int NOT NULL, PRIMARY KEY (`product_id`,`order_id`), KEY `IDX_2530ADE64584665A` (`product_id`), KEY `IDX_2530ADE68D9F6D38` (`order_id`), CONSTRAINT `FK_2530ADE64584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE, CONSTRAINT `FK_2530ADE68D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        $this->addSql('CREATE TABLE `product_provider` (`provider_id` int NOT NULL, `product_id` int NOT NULL, PRIMARY KEY (`provider_id`,`product_id`), KEY `IDX_5974190BA53A8AA` (`provider_id`), KEY `IDX_5974190B4584665A` (`product_id`), CONSTRAINT `FK_5974190B4584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE, CONSTRAINT `FK_5974190BA53A8AA` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
        $this->addSql('CREATE TABLE `product_purchase_order` (`product_id` int NOT NULL, `purchaseorder_id` int NOT NULL, PRIMARY KEY (`product_id`,`purchaseorder_id`), KEY `IDX_25237124584665A` (`product_id`), KEY `IDX_2523712E20D463C` (`purchaseorder_id`), CONSTRAINT `FK_25237124584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE, CONSTRAINT `FK_2523712E20D463C` FOREIGN KEY (`purchaseorder_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');

        $this->addSql('ALTER TABLE `stocks` ADD UNIQUE KEY `UNIQ_56F798054584665A` (`product_id`)');
        $this->addSql('ALTER TABLE `stocks` ADD CONSTRAINT FK_56F798054584665A FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE `products` ADD UNIQUE KEY `UNIQ_B3BA5A5ADCD6110` (`stock_id`)');
        $this->addSql('ALTER TABLE `products` ADD CONSTRAINT `FK_B3BA5A5ADCD6110` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`)');
        $this->addSql('ALTER TABLE `users` ADD  UNIQUE KEY `UNIQ_1483A5E98C03F15C` (`employee_id`)');
        $this->addSql('ALTER TABLE `users` ADD UNIQUE KEY `UNIQ_1483A5E99395C3F3` (`customer_id`)');
        $this->addSql('ALTER TABLE `users` ADD UNIQUE KEY `UNIQ_1483A5E9642B8210` (`admin_id`)');
        $this->addSql('ALTER TABLE `users` ADD CONSTRAINT `FK_1483A5E9642B8210` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`)');
        $this->addSql('ALTER TABLE `users` ADD CONSTRAINT `FK_1483A5E98C03F15C` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`)');
        $this->addSql('ALTER TABLE `users` ADD CONSTRAINT `FK_1483A5E99395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)');
        $this->addSql('ALTER TABLE `products` ADD KEY `IDX_7EA244344584665A` (`brand_id`)');
        $this->addSql('ALTER TABLE `products` ADD CONSTRAINT `FK_7EA244344584665A` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`)');
        $this->addSql('ALTER TABLE `characteristic` ADD KEY `IDX_522FA9504584665A` (`product_id`)');
        $this->addSql('ALTER TABLE `characteristic` ADD CONSTRAINT `FK_522FA9504584665A` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)');
        $this->addSql('ALTER TABLE `filter_options` ADD KEY `IDX_67A58DE2D395B25E` (`filter_id`)');
        $this->addSql('ALTER TABLE `filter_options` ADD CONSTRAINT `FK_67A58DE2D395B25E` FOREIGN KEY (`filter_id`) REFERENCES `filters` (`id`)');
        $this->addSql('ALTER TABLE `filters` ADD KEY `IDX_7877678D12469DE2` (`category_id`)');
        $this->addSql('ALTER TABLE `filters` ADD CONSTRAINT `FK_7877678D12469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)');
        $this->addSql('ALTER TABLE `orders` ADD  KEY `IDX_E52FFDEE9395C3F3` (`customer_id`)');
        $this->addSql('ALTER TABLE `orders` ADD KEY `IDX_E52FFDEE8C03F15C` (`employee_id`)');
        $this->addSql('ALTER TABLE `orders` ADD CONSTRAINT `FK_E52FFDEE8C03F15C` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`)');
        $this->addSql('ALTER TABLE `orders` ADD CONSTRAINT `FK_E52FFDEE9395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)');
        $this->addSql('ALTER TABLE `providers` ADD KEY `IDX_E225D41744F5D008` (`brand_id`)');
        $this->addSql('ALTER TABLE `providers` ADD CONSTRAINT `FK_E225D41744F5D008` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`)');
        $this->addSql('ALTER TABLE `purchase_orders` ADD KEY `IDX_3E40FFBBA53A8AA` (`provider_id`)');
        $this->addSql('ALTER TABLE `purchase_orders` ADD KEY `IDX_3E40FFBB7C27AE3` (`buyer_user_id`)');
        $this->addSql('ALTER TABLE `purchase_orders` ADD CONSTRAINT `FK_3E40FFBB7C27AE3` FOREIGN KEY (`buyer_user_id`) REFERENCES `employees` (`id`)');
        $this->addSql('ALTER TABLE `purchase_orders` ADD CONSTRAINT `FK_3E40FFBBA53A8AA` FOREIGN KEY (`provider_id`) REFERENCES `providers` (`id`)');
        $this->addSql('ALTER TABLE `tokens` ADD UNIQUE KEY `UNIQ_AA5A118EA76ED395` (`user_id`)');
        $this->addSql('ALTER TABLE `tokens` ADD CONSTRAINT `FK_AA5A118EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE tokens DROP FOREIGN KEY FK_AA5A118EA76ED395');
        $this->addSql('ALTER TABLE tokens DROP FOREIGN KEY FK_AA5A118EA76ED396');
        $this->addSql('ALTER TABLE tokens DROP FOREIGN KEY FK_AA5A118EA76ED397');
        $this->addSql('ALTER TABLE tokens DROP FOREIGN KEY FK_AA5A118EA76ED398');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE employees');
        $this->addSql('DROP TABLE tokens');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE admins');
    }
}
