
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `colissimo_home_delivery_area_freeshipping`;

CREATE TABLE `colissimo_home_delivery_area_freeshipping`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `area_id` INTEGER NOT NULL,
    `cart_amount` DECIMAL(18,2) DEFAULT 0.00,
    PRIMARY KEY (`id`),
    INDEX `FI_colissimo_home_delivery_area_freeshipping_area_id` (`area_id`),
    CONSTRAINT `fk_colissimo_home_delivery_area_freeshipping_area_id`
        FOREIGN KEY (`area_id`)
            REFERENCES `area` (`id`)
            ON UPDATE RESTRICT
            ON DELETE RESTRICT
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;