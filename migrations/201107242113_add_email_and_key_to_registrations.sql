ALTER TABLE `registrations`
	ADD COLUMN `email` VARCHAR(50) NOT NULL AFTER `meal_id`,
	ADD COLUMN `salt` VARCHAR(10) NOT NULL AFTER `email`
