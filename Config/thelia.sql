
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- colissimo_home_delivery_price_slices
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `colissimo_home_delivery_price_slices`;

CREATE TABLE `colissimo_home_delivery_price_slices`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `area_id` INTEGER NOT NULL,
    `max_weight` FLOAT,
    `max_price` FLOAT,
    `shipping` FLOAT NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `fi_colissimo_home_delivery_price_slices_area_id` (`area_id`),
    CONSTRAINT `fk_colissimo_home_delivery_price_slices_area_id`
        FOREIGN KEY (`area_id`)
        REFERENCES `area` (`id`)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- colissimo_home_delivery_freeshipping
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `colissimo_home_delivery_freeshipping`;

CREATE TABLE `colissimo_home_delivery_freeshipping`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `active` TINYINT(1) DEFAULT 0,
    `freeshipping_from` DECIMAL(18,2),
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- colissimo_home_delivery_area_freeshipping
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `colissimo_home_delivery_area_freeshipping`;

CREATE TABLE `colissimo_home_delivery_area_freeshipping`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `area_id` INTEGER NOT NULL,
    `cart_amount` DECIMAL(18,2) DEFAULT 0.00,
    PRIMARY KEY (`id`),
    INDEX `fi_colissimo_home_delivery_area_freeshipping_area_id` (`area_id`),
    CONSTRAINT `fk_colissimo_home_delivery_area_freeshipping_area_id`
        FOREIGN KEY (`area_id`)
        REFERENCES `area` (`id`)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
