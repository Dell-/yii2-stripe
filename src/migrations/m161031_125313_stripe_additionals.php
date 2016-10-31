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
            CREATE TABLE IF NOT EXISTS `user` (
              `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
              PRIMARY KEY (`id`))
            ENGINE = InnoDB;
            '
        );

        $this->execute(
            '
            CREATE TABLE IF NOT EXISTS `payment_order` (
              `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
              `user_id` INT UNSIGNED NOT NULL,
              `amount` DECIMAL(9,2) NOT NULL,
              `status` TINYINT UNSIGNED NOT NULL,
              `created_at` INT UNSIGNED NOT NULL,
              `updated_at` INT UNSIGNED NOT NULL,
              PRIMARY KEY (`id`),
              INDEX `user_id` (`user_id` ASC),
              CONSTRAINT `fk_payment_order_1`
                FOREIGN KEY (`user_id`)
                REFERENCES `user` (`id`)
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
