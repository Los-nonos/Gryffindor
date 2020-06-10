<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20200609194054 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255), description VARCHAR(255), price FLOAT, taxes FLOAT, category_id INTEGER, stock_id INTEGER, characteristic_id INTEGER,  PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255), filter_id INTEGER, product_id INTEGER, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filters (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255), category_id INTEGER, options_id INTEGER, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE characteristics (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255), property VARCHAR(255), product_id INTEGER, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filter_options (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255), filter_id INTEGER, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, products_id INTEGER, customer_id INTEGER, seller_id INTEGER, amount FLOAT, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stocks (id INT AUTO_INCREMENT NOT NULL, product_id INTEGER, quantity INTEGER, remanentQuantity INTEGER, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_AA5A118EA76ED312 FOREIGN KEY (characteristic_id) REFERENCES characteristics (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_AA5A118EA76ED313 FOREIGN KEY (stock_id) REFERENCES stocks (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_AA5A118EA76ED314 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_AA5A118EA76ED315 FOREIGN KEY (filter_id) REFERENCES filters (id)');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_AA5A118EA76ED316 FOREIGN KEY (product_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE filters ADD CONSTRAINT FK_AA5A118EA76ED317 FOREIGN KEY (options_id) REFERENCES filter_options (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_AA5A118EA76ED318 FOREIGN KEY (products_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_AA5A118EA76ED319 FOREIGN KEY (customer_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_AA5A118EA76ED320 FOREIGN KEY (seller_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE stocks ADD CONSTRAINT FK_AA5A118EA76ED321 FOREIGN KEY (product_id) REFERENCES products (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY  FK_AA5A118EA76ED312');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY  FK_AA5A118EA76ED313');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY  FK_AA5A118EA76ED314');
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY  FK_AA5A118EA76ED315');
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY  FK_AA5A118EA76ED316');
        $this->addSql('ALTER TABLE filters DROP FOREIGN KEY  FK_AA5A118EA76ED317');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY  FK_AA5A118EA76ED318');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY  FK_AA5A118EA76ED319');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY  FK_AA5A118EA76ED320');
        $this->addSql('ALTER TABLE stocks DROP FOREIGN KEY  FK_AA5A118EA76ED321');

        $this->addSql('DROP TABLE IF EXISTS products');
        $this->addSql('DROP TABLE IF EXISTS categories');
        $this->addSql('DROP TABLE IF EXISTS filters');
        $this->addSql('DROP TABLE IF EXISTS characteristics');
        $this->addSql('DROP TABLE IF EXISTS filter_options');
        $this->addSql('DROP TABLE IF EXISTS orders');
        $this->addSql('DROP TABLE IF EXISTS stocks');
    }
}
