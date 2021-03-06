<?php
/**
 * Copyright © 2016 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
use yii\db\Migration;

class m161031_125314_stripe_setup extends Migration
{
    public function up()
    {
        $this->execute(
            '
            CREATE TABLE IF NOT EXISTS `stripe_customer` (
              `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
              `uid` VARCHAR(255) NOT NULL,
              `user_id` INT UNSIGNED NOT NULL,
              `mode` ENUM(\'live\', \'test\') NOT NULL,
              `email` VARCHAR(255) NOT NULL,
              `description` VARCHAR(255) NULL,
              `currency` VARCHAR(3) NULL,
              `created_at` INT UNSIGNED NOT NULL,
              `updated_at` INT UNSIGNED NOT NULL,
              PRIMARY KEY (`id`),
              INDEX `user_id` (`user_id` ASC),
              INDEX `email` (`email` ASC),
              UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
              CONSTRAINT `fk_stripe_customer_1`
                FOREIGN KEY (`user_id`)
                REFERENCES `user` (`id`)
                ON DELETE CASCADE
                ON UPDATE CASCADE)
            CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB;
            '
        );

        $this->execute(
            '
            CREATE TABLE IF NOT EXISTS `stripe_source_card` (
              `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
              `customer_id` INT UNSIGNED NOT NULL,
              `uid` VARCHAR(255) NOT NULL,
              `mode` ENUM(\'live\', \'test\') NOT NULL,
              `brand` VARCHAR(45) NOT NULL,
              `funding` VARCHAR(128) NOT NULL,
              `exp_month` TINYINT NOT NULL,
              `exp_year` SMALLINT NOT NULL,
              `last4` CHAR(4) NOT NULL,
              `data` LONGTEXT NOT NULL,
              `is_default` TINYINT UNSIGNED NOT NULL,
              `created_at` INT UNSIGNED NOT NULL,
              PRIMARY KEY (`id`),
              INDEX `customer_id` (`customer_id` ASC),
              UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
              CONSTRAINT `fk_stripe_source_card_1`
                FOREIGN KEY (`customer_id`)
                REFERENCES `stripe_customer` (`id`)
                ON DELETE CASCADE
                ON UPDATE CASCADE)
            CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB;
            '
        );

        $this->execute(
            '
            CREATE TABLE IF NOT EXISTS `stripe_card_address` (
              `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
              `customer_id` INT UNSIGNED NOT NULL,
              `card_id` INT UNSIGNED NOT NULL,
              `uid` VARCHAR(255) NOT NULL,
              `city` VARCHAR(255) NULL,
              `country` VARCHAR(255) NULL,
              `line1` VARCHAR(255) NULL,
              `line2` VARCHAR(255) NULL,
              `state` VARCHAR(255) NULL,
              `zip` VARCHAR(255) NULL,
              `created_at` INT UNSIGNED NOT NULL,
              `updated_at` INT UNSIGNED NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
              INDEX `customer_id` (`customer_id` ASC),
              INDEX `card_id` (`customer_id` ASC),
              CONSTRAINT `fk_stripe_card_address_1`
                FOREIGN KEY (`customer_id`)
                REFERENCES `stripe_customer` (`id`)
                ON DELETE CASCADE
                ON UPDATE CASCADE,
              CONSTRAINT `fk_stripe_card_address_2`
                FOREIGN KEY (`card_id`)
                REFERENCES `stripe_source_card` (`id`)
                ON DELETE CASCADE
                ON UPDATE CASCADE)
            CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB;
            '
        );

        $this->execute(
            '
            CREATE TABLE IF NOT EXISTS `stripe_transaction` (
              `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
              `uid` VARCHAR(255) NOT NULL,
              `order_id` INT UNSIGNED NOT NULL,
              `customer_id` INT UNSIGNED NOT NULL,
              `mode` ENUM(\'live\', \'test\') NOT NULL,
              `type` SMALLINT UNSIGNED NOT NULL,
              `status` SMALLINT UNSIGNED NOT NULL,
              `amount` INT UNSIGNED NOT NULL,
              `description` TEXT NULL,
              `data` LONGTEXT NOT NULL,
              `created_at` INT UNSIGNED NOT NULL,
              PRIMARY KEY (`id`),
              INDEX `customer_id` (`customer_id` ASC),
              UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
              INDEX `order_id` (`order_id` ASC),
              CONSTRAINT `fk_stripe_transaction_1`
                FOREIGN KEY (`customer_id`)
                REFERENCES `stripe_customer` (`id`)
                ON DELETE CASCADE
                ON UPDATE CASCADE)
            CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB;
            '
        );
    }

    public function down()
    {
        echo "m161031_125314_stripe_setup cannot be reverted.\n";

        return false;
    }
}
