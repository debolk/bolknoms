ALTER TABLE `meals`
	ADD COLUMN `event` VARCHAR(50) NULL AFTER `locked`,
	ADD COLUMN `promoted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0' AFTER `event`;
