ALTER TABLE `meals`
	ADD COLUMN `locked` TIME NOT NULL AFTER `date`;