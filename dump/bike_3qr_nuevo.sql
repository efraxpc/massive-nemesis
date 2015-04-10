-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.17 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla bike_3qr_nuevo.admin_permission
CREATE TABLE IF NOT EXISTS `admin_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `confirmed` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bike_3qr_nuevo.admin_permission: ~0 rows (aproximadamente)
DELETE FROM `admin_permission`;
/*!40000 ALTER TABLE `admin_permission` DISABLE KEYS */;
INSERT INTO `admin_permission` (`id`, `confirmed`, `created_at`, `updated_at`) VALUES
	(1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `admin_permission` ENABLE KEYS */;


-- Volcando estructura para tabla bike_3qr_nuevo.assigned_roles
CREATE TABLE IF NOT EXISTS `assigned_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `role_auxilar` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assigned_roles_user_id_foreign` (`user_id`),
  KEY `assigned_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `assigned_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `assigned_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bike_3qr_nuevo.assigned_roles: ~4 rows (aproximadamente)
DELETE FROM `assigned_roles`;
/*!40000 ALTER TABLE `assigned_roles` DISABLE KEYS */;
INSERT INTO `assigned_roles` (`id`, `user_id`, `role_id`, `role_auxilar`) VALUES
	(43, 41, 2, 'user'),
	(56, 53, 1, 'admin'),
	(58, 55, 1, 'admin'),
	(59, 56, 2, 'user'),
	(60, 57, 2, 'user'),
	(61, 72, 2, 'user');
/*!40000 ALTER TABLE `assigned_roles` ENABLE KEYS */;


-- Volcando estructura para procedimiento bike_3qr_nuevo.delete_user
DELIMITER //
CREATE   PROCEDURE `delete_user`(IN `id_user` INT)
BEGIN
	DELETE FROM users WHERE id = id_user;
	DELETE FROM assigned_roles WHERE user_id = id_user;
END//
DELIMITER ;


-- Volcando estructura para tabla bike_3qr_nuevo.files
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `ruta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tamaño` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `profile` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `files_user_id_foreign` (`user_id`),
  CONSTRAINT `files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bike_3qr_nuevo.files: ~1 rows (aproximadamente)
DELETE FROM `files`;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` (`id`, `nombre`, `ruta`, `tipo`, `tamaño`, `user_id`, `profile`, `created_at`, `updated_at`) VALUES
	(97, 'imagen__5526e8d99fbd3', 'C:\\wamp\\www\\qrcode\\public/uploads/', 'Koala.jpg', '762.5302734375', 56, 0, '2015-04-09 21:02:17', '2015-04-09 21:02:17');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;


-- Volcando estructura para procedimiento bike_3qr_nuevo.insert_aux_role_in_assigned_roles_table
DELIMITER //
CREATE   PROCEDURE `insert_aux_role_in_assigned_roles_table`(IN `id_user` INT, IN `slug` VARCHAR(50))
BEGIN
	UPDATE assigned_roles 
	SET role_auxilar = slug
	WHERE user_id = id_user;
END//
DELIMITER ;


-- Volcando estructura para función bike_3qr_nuevo.max_7_files_asociated_in_files_table
DELIMITER //
CREATE   FUNCTION `max_7_files_asociated_in_files_table`(`user_id` INT) RETURNS tinyint(4)
BEGIN
	DECLARE cantidad_reistros_usuario_files INT DEFAULT 0;
	DECLARE total_count INT DEFAULT 0;
	DECLARE response TINYINT DEFAULT 0;
	
	SET cantidad_reistros_usuario_files = 10;
	
	SELECT COUNT(id) INTO cantidad_reistros_usuario_files FROM files;
	
	SELECT COUNT(files.id) FROM files JOIN users ON users.id = files.user_id WHERE users.id = user_id INTO total_count;
	
	IF total_count >= 7 THEN
		SET response = 1;
	ELSE
		SET response = 0;
   END IF;
   
	RETURN response;
END//
DELIMITER ;


-- Volcando estructura para tabla bike_3qr_nuevo.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bike_3qr_nuevo.migrations: ~21 rows (aproximadamente)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`migration`, `batch`) VALUES
	('2015_03_05_013332_confide_setup_users_table', 1),
	('2015_03_06_093213_add_new_fields_to_users_table', 2),
	('2015_03_06_132133_changing_file_names_in_users_table_and_rename_them', 3),
	('2015_03_06_133403_refactoring_serial_marco_field_in_users_table', 4),
	('2015_03_06_133723_adding_serial_marco_field_in_users_table', 5),
	('2015_03_06_235831_create_tipo_de_sangre_table', 6),
	('2015_03_07_063052_drop_grupo_sanguineo_field', 7),
	('2015_03_07_063616_add_grupo_sanguineo_field_foreingKey', 8),
	('2015_03_07_071916_add_grupo_sanguineo_id_foreingkey', 9),
	('2015_03_07_082931_entrust_setup_tables', 10),
	('2015_03_07_135120_nulling_extra_fiels_in_users_table', 11),
	('2015_03_08_061022_set_null_extra_fields_in_users_table', 12),
	('2015_03_08_061347_create_tipo_de_sangre_foreingkey_again', 13),
	('2015_03_08_061856_create_tipo_de_sangre_foreingkey_again_2', 14),
	('2015_03_13_140659_add_active_field_in_users_table', 15),
	('2015_03_14_042049_add_name_field_in_users_table', 16),
	('2015_03_19_204551_add_qrcode_field', 17),
	('2015_03_21_040609_add_qrcode_full_field_to_users_table', 18),
	('2015_03_23_001019_remove_qrcode_full_field_from_users_table', 19),
	('2015_03_25_135704_create_file_table', 20),
	('2015_03_30_094459_create_lat_and_lng_fields_in_users_table', 21),
	('2015_04_01_120104_create_role_aux_nullable_field_in_users_table', 22),
	('2015_04_01_145006_add_role_auxilar_in_assigned_roles', 23),
	('2015_04_01_181724_create_admin_permission_table', 24),
	('2015_04_09_150830_add_profile_boolean_field_in_files_tables', 25);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Volcando estructura para tabla bike_3qr_nuevo.password_reminders
CREATE TABLE IF NOT EXISTS `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bike_3qr_nuevo.password_reminders: ~4 rows (aproximadamente)
DELETE FROM `password_reminders`;
/*!40000 ALTER TABLE `password_reminders` DISABLE KEYS */;
INSERT INTO `password_reminders` (`email`, `token`, `created_at`) VALUES
	('efraxpc@gmail.com', '7cda6b29c88b4cd99aac78f12d96dbc2', '2015-03-06 08:01:11'),
	('efraxpc@gmail.com', '65c7781bcf522b83c4543f2c063eaa14', '2015-03-06 08:01:28'),
	('efraxpc@gmail.com', '9a234941335bb0f9399451a9eb1d2133', '2015-03-26 15:11:16'),
	('efraxpc@gmail.com', '5692257efa141134c316f84a0341fcd0', '2015-03-26 15:14:41');
/*!40000 ALTER TABLE `password_reminders` ENABLE KEYS */;


-- Volcando estructura para tabla bike_3qr_nuevo.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bike_3qr_nuevo.permissions: ~2 rows (aproximadamente)
DELETE FROM `permissions`;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
	(1, 'manage_profile', 'Manage Profile', '2015-03-07 09:06:22', '2015-03-07 09:06:22'),
	(2, 'manage_users', 'Manage Users', '2015-03-07 09:06:22', '2015-03-07 09:06:22');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;


-- Volcando estructura para tabla bike_3qr_nuevo.permission_role
CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bike_3qr_nuevo.permission_role: ~2 rows (aproximadamente)
DELETE FROM `permission_role`;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES
	(1, 2, 1),
	(2, 1, 2);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;


-- Volcando estructura para procedimiento bike_3qr_nuevo.profile_image_asociated_in_files_table
DELIMITER //
CREATE   PROCEDURE `profile_image_asociated_in_files_table`(IN `user_id_entrada` INT)
BEGIN
	DECLARE id_ int(5); 
	DECLARE nombre_ VARCHAR(50); 
	DECLARE tipo_ VARCHAR(50); 
	DECLARE total_count INT(5);
	DECLARE response_ INT(5);

   SELECT id      INTO id_     FROM files WHERE profile = 1 AND user_id = user_id_entrada;
   SELECT nombre  INTO nombre_ FROM files WHERE profile = 1 AND user_id = user_id_entrada;
   SELECT tipo    INTO tipo_   FROM files WHERE profile = 1 AND user_id = user_id_entrada;
	
	DROP TABLE IF EXISTS `array_datos`;
	
	CREATE TEMPORARY TABLE IF NOT EXISTS array_datos (
	id     INT (5) ,
	nombre VARCHAR(30) ,
	tipo   VARCHAR(30) ,
	max_file INT(5)     );
	
	SELECT COUNT(files.id) FROM files JOIN users ON users.id = files.user_id WHERE users.id = user_id_entrada AND files.profile = 1 INTO total_count;
	
	IF total_count >= 1 THEN
		SET response_ = 1;
	ELSE
		SET response_ = 0;
   END IF;
	
	INSERT INTO array_datos (id,nombre,tipo,max_file) VALUES (id_,nombre_,tipo_,response_);
	SELECT * FROM array_datos;

END//
DELIMITER ;


-- Volcando estructura para tabla bike_3qr_nuevo.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bike_3qr_nuevo.roles: ~2 rows (aproximadamente)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', '2015-03-07 09:06:22', '2015-03-07 09:06:22'),
	(2, 'users', '2015-03-07 09:06:22', '2015-03-07 09:06:22'),
	(4, 'redemption', '2015-03-31 15:33:23', '2015-03-31 15:33:23');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Volcando estructura para procedimiento bike_3qr_nuevo.select_assigned_roles
DELIMITER //
CREATE   PROCEDURE `select_assigned_roles`()
BEGIN
	SELECT * FROM assigned_roles ORDER BY role_auxilar DESC;
END//
DELIMITER ;


-- Volcando estructura para procedimiento bike_3qr_nuevo.select_habilitar_registro_admin_option
DELIMITER //
CREATE   PROCEDURE `select_habilitar_registro_admin_option`()
BEGIN
	SELECT confirmed FROM admin_permission;
END//
DELIMITER ;


-- Volcando estructura para procedimiento bike_3qr_nuevo.select_imagenes_de_usuario
DELIMITER //
CREATE   PROCEDURE `select_imagenes_de_usuario`(IN `id_user` int)
BEGIN
	#Routine body goes here...
SELECT * FROM files WHERE user_id = id_user;
END//
DELIMITER ;


-- Volcando estructura para procedimiento bike_3qr_nuevo.select_role_of_user
DELIMITER //
CREATE   PROCEDURE `select_role_of_user`(IN `id_user` INT)
BEGIN
	SELECT role_auxilar as rol_usuario FROM users WHERE id = id_user;
END//
DELIMITER ;


-- Volcando estructura para procedimiento bike_3qr_nuevo.select_users
DELIMITER //
CREATE   PROCEDURE `select_users`()
BEGIN
	SELECT * FROM users ORDER BY role_auxilar DESC;
END//
DELIMITER ;


-- Volcando estructura para tabla bike_3qr_nuevo.tipo_de_sangre
CREATE TABLE IF NOT EXISTS `tipo_de_sangre` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bike_3qr_nuevo.tipo_de_sangre: ~8 rows (aproximadamente)
DELETE FROM `tipo_de_sangre`;
/*!40000 ALTER TABLE `tipo_de_sangre` DISABLE KEYS */;
INSERT INTO `tipo_de_sangre` (`id`, `nombre`) VALUES
	(1, 'A+'),
	(2, 'A-'),
	(3, 'B+'),
	(4, 'B-'),
	(5, 'O+'),
	(6, 'O-'),
	(7, 'AB+'),
	(8, 'AB-');
/*!40000 ALTER TABLE `tipo_de_sangre` ENABLE KEYS */;


-- Volcando estructura para procedimiento bike_3qr_nuevo.update_permissions_create_admin_
DELIMITER //
CREATE   PROCEDURE `update_permissions_create_admin_`(IN `switch_active_value` INT)
BEGIN
	IF (switch_active_value = 1) THEN
		UPDATE admin_permission SET confirmed = 1 WHERE id = 1;
	ELSE
		UPDATE admin_permission SET confirmed = 0 WHERE id = 1;
	END IF;
END//
DELIMITER ;


-- Volcando estructura para procedimiento bike_3qr_nuevo.update_role_user
DELIMITER //
CREATE   PROCEDURE `update_role_user`(IN `id_user` INT, IN `switch_active_value` INT)
BEGIN
    IF (switch_active_value = 0) THEN
        UPDATE assigned_roles SET role_id = 4 WHERE user_id = id_user;
    ELSEIF (switch_active_value = 1) THEN
        UPDATE assigned_roles SET role_id = 2 WHERE user_id = id_user;
    END IF;
END//
DELIMITER ;


-- Volcando estructura para tabla bike_3qr_nuevo.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `eps` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observaciones_generales` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `serial_marco` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `grupo_sanguineo_id` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `nombre_completo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qrcode` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lat` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lng` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_auxilar` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_grupo_sanguineo_id_foreign` (`grupo_sanguineo_id`),
  CONSTRAINT `users_grupo_sanguineo_id_foreign` FOREIGN KEY (`grupo_sanguineo_id`) REFERENCES `tipo_de_sangre` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bike_3qr_nuevo.users: ~6 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `password`, `confirmation_code`, `remember_token`, `confirmed`, `created_at`, `updated_at`, `eps`, `observaciones_generales`, `facebook`, `twitter`, `fecha_nacimiento`, `serial_marco`, `grupo_sanguineo_id`, `active`, `nombre_completo`, `qrcode`, `lat`, `lng`, `role_auxilar`) VALUES
	(41, 'albeiroaranzazu@gmail.com', '$2y$10$DDbOUzy1m3gzv7KemS1RmOpT2PPd/A3yY3MXjjrAhOi..UATXRIlq', '21f6acc681ce09b7e4ec1d9d04a5216d', NULL, 1, '2015-03-26 16:03:25', '2015-03-27 23:08:52', 'COOMEVA', 'ASLDHASKLÑDA\r\nSDAS\r\nDAS\r\nDAS\r\n', '', '', '1975-03-25 22:38:52', '12345', 2, 1, 'joaquin', '551426c578187', '', '', 'user'),
	(53, 'efraxpc@gmail.com', '$2y$10$vhEHLfOVkx4oBtv3vwKTG..ZQXyiy5VbUL0lWW01WD5VT2y.V/3JW', '7a3800619a9042cf57e0092bc9cba43f', 'LbDqbmPh5SCwC2v4Og6ERIDcAQfAzNy6i0wxrkezuFUluUMA18v24B6okBAI', 1, '2015-04-01 17:58:49', '2015-04-03 14:09:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '551c31d9901b7', NULL, NULL, 'admin'),
	(55, '1@gmail.com', '$2y$10$OH9oiqrLLFUL.V5EdEESTOCc4TfN1sHlioIxnfcscD8sZVpPM7h.i', '5647d644934b73e17e51040bb1caf56d', 'HQhzFizAqyMWjQu64GP5XCWpFuLgFAo3L7r2EWd7MPfyjc1EHrxvKNShtxYU', 1, '2015-04-02 21:02:17', '2015-04-06 11:41:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '551dae59ad06a', NULL, NULL, 'admin'),
	(56, 'cameliaguerrero@hotmail.com', '$2y$10$BtIlX9M3v/CJS0K4PuGNqeIx3j/RVmeiCbcsL7hh2oIwADs6IYgWC', 'cb643e060d6cf208a719de4802300088', '9iD8swWvlVGtF3EVVp8igjPxx0vI6CqyavNMnGUpX1T58D299yNKbryVOFwY', 1, '2015-04-03 10:50:40', '2015-04-09 14:50:29', 'COOMEVA', 'obervaciones deqqqqq camelia', 'my facebook', 'my twitter', '2016-01-20 11:34:35', '12345', 2, 1, 'Camelia', '551e7080a876c', '-3.077', '-59.992', 'user'),
	(57, 're@gmail.com', '$2y$10$dRi27RV9lxrvkkcch4L5e.gh5Wpz.03JtEt8NDFkg.wb5ZIxW1oSG', '3878d156bf4bfd4570a6829c58f7449f', 'nOaf1QSttX4yPx7KWyX783QhIOSULgdvL4pXCZIWqOR1yHMop6WG2ikII7yG', 1, '2015-04-03 13:48:36', '2015-04-03 14:09:20', 'tg', 'tg', 'tgt', 'tbt', '1970-01-01 13:52:40', 'tg', 2, 1, 'tg', '551e9a34501c3', '0.265', '-71.930', 'user'),
	(58, 'cameliagueeerrero@hotmail.com', '$2y$10$mudsMBKJLXl2vEaqqYtxy.Zf5ThuvRX/EvePQZbkv7ZjnpglZ.abO', 'aac5d2aa35399798130e59d7e92494bd', NULL, 0, '2015-04-05 19:42:56', '2015-04-05 19:42:56', 'Eps', 'Observaciones Generales ', 'Facebook', 'Twitter', '1970/01/01 00:00:00', 'Serial de Marco', 2, 1, 'Nombre Completo', '5521903fc68b6', '4.589', '-73.930', 'user'),
	(72, 'doln@gmail.com', '$2y$10$M1JPz8dt7kOCR2QHEtyFsemosmhHf6lF1uweo1zCqlZD5dN7hq75a', '643220fd802464ef68be194e6245c18c', NULL, 0, '2015-04-08 22:16:55', '2015-04-08 22:16:55', 'ef', 'ef', 'ef', 'ef', '2015/02/05 00:00:00', 'ef', 2, 1, 'eefe', '5525a8d763de9', '0.529', '-70.326', 'user');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
