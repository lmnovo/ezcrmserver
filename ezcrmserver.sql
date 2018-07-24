-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.19 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para ezcrmserver
CREATE DATABASE IF NOT EXISTS `ezcrmserver` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ezcrmserver`;

-- Volcando estructura para tabla ezcrmserver.business
CREATE TABLE IF NOT EXISTS `business` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `cms_users_id` int(11) DEFAULT NULL,
  `leads_id` int(11) DEFAULT NULL,
  `stages_id` int(11) DEFAULT NULL,
  `stages_groups_id` int(11) DEFAULT NULL,
  `date_limit` date DEFAULT NULL,
  `total` double DEFAULT '0',
  `is_active` int(11) DEFAULT '0',
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_business_cms_users` (`cms_users_id`),
  KEY `FK_business_leads` (`leads_id`),
  KEY `FK_business_stages` (`stages_id`),
  KEY `FK_business_stages_groups` (`stages_groups_id`),
  CONSTRAINT `FK_business_cms_users` FOREIGN KEY (`cms_users_id`) REFERENCES `cms_users` (`id`),
  CONSTRAINT `FK_business_leads` FOREIGN KEY (`leads_id`) REFERENCES `leads` (`id`),
  CONSTRAINT `FK_business_stages` FOREIGN KEY (`stages_id`) REFERENCES `stages` (`id`),
  CONSTRAINT `FK_business_stages_groups` FOREIGN KEY (`stages_groups_id`) REFERENCES `stages_groups` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla ezcrmserver.business: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `business` DISABLE KEYS */;
/*!40000 ALTER TABLE `business` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.business_stages
CREATE TABLE IF NOT EXISTS `business_stages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_id` int(11) DEFAULT NULL,
  `stages_id` int(11) DEFAULT NULL,
  `notes` text,
  `files` longtext,
  `is_completed` int(11) DEFAULT '0',
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla ezcrmserver.business_stages: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `business_stages` DISABLE KEYS */;
/*!40000 ALTER TABLE `business_stages` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.campaigns_leads
CREATE TABLE IF NOT EXISTS `campaigns_leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leads_id` int(11) DEFAULT '0',
  `campaigns_id` int(11) DEFAULT '0',
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla ezcrmserver.campaigns_leads: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `campaigns_leads` DISABLE KEYS */;
/*!40000 ALTER TABLE `campaigns_leads` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.campaign_automations
CREATE TABLE IF NOT EXISTS `campaign_automations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT 'empty',
  `to` text COLLATE utf8mb4_unicode_ci,
  `subject` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `type` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cms_email_templates_id` int(11) DEFAULT NULL,
  `cms_users_id` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT '0',
  `total_sent` int(11) DEFAULT '0',
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.campaign_automations: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `campaign_automations` DISABLE KEYS */;
/*!40000 ALTER TABLE `campaign_automations` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.cms_apicustom
CREATE TABLE IF NOT EXISTS `cms_apicustom` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permalink` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tabel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aksi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kolom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderby` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_query_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sql_where` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method_type` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` longtext COLLATE utf8mb4_unicode_ci,
  `responses` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.cms_apicustom: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_apicustom` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_apicustom` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.cms_apikey
CREATE TABLE IF NOT EXISTS `cms_apikey` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `screetkey` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hit` int(11) DEFAULT NULL,
  `status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.cms_apikey: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_apikey` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_apikey` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.cms_dashboard
CREATE TABLE IF NOT EXISTS `cms_dashboard` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_cms_privileges` int(11) DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.cms_dashboard: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_dashboard` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_dashboard` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.cms_email_queues
CREATE TABLE IF NOT EXISTS `cms_email_queues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `send_at` datetime DEFAULT NULL,
  `email_recipient` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_cc_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_content` text COLLATE utf8mb4_unicode_ci,
  `email_attachments` text COLLATE utf8mb4_unicode_ci,
  `is_sent` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.cms_email_queues: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_email_queues` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_email_queues` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.cms_email_templates
CREATE TABLE IF NOT EXISTS `cms_email_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cc_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.cms_email_templates: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_email_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_email_templates` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.cms_logs
CREATE TABLE IF NOT EXISTS `cms_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ipaddress` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `useragent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_cms_users` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.cms_logs: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_logs` DISABLE KEYS */;
INSERT INTO `cms_logs` (`id`, `created_at`, `updated_at`, `ipaddress`, `useragent`, `url`, `description`, `id_cms_users`) VALUES
	(1, '2018-07-09', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 'http://18.222.4.15/crm/module_generator/delete/28', 'Delete data Tasks Type at Module Generator', 4),
	(2, '2018-07-09', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 'http://18.222.4.15/crm/logout', 'juan@gmail.com logout', 4),
	(3, '2018-07-09', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 'http://18.222.4.15/crm/login', 'admin@gmail.com login with IP Address 127.0.0.1', 1),
	(4, '2018-07-09', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 'http://18.222.4.15/crm/logout', 'admin@gmail.com logout', 1),
	(5, '2018-07-09', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 'http://18.222.4.15/crm/login', 'admin@gmail.com login with IP Address 127.0.0.1', 1),
	(6, '2018-07-15', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'http://18.222.4.15/crm/login', 'admin@gmail.com login with IP Address 127.0.0.1', 1),
	(7, '2018-07-15', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'http://18.222.4.15/crm/login', 'admin@gmail.com login with IP Address 127.0.0.1', 1),
	(8, '2018-07-15', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 'http://18.222.4.15/crm/leads/add-save', 'Add New Data Julio at Leads', 1);
/*!40000 ALTER TABLE `cms_logs` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.cms_menus
CREATE TABLE IF NOT EXISTS `cms_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'url',
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_dashboard` tinyint(1) NOT NULL DEFAULT '0',
  `id_cms_privileges` int(11) DEFAULT NULL,
  `sorting` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.cms_menus: ~59 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_menus` DISABLE KEYS */;
INSERT INTO `cms_menus` (`id`, `name`, `type`, `path`, `color`, `icon`, `parent_id`, `is_active`, `is_dashboard`, `id_cms_privileges`, `sorting`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(41, 'Brands', 'Route', 'AdminBrandsControllerGetIndex', 'normal', 'fa fa-bars', 0, 0, 0, 1, 21, '2017-12-21 14:03:36', NULL, NULL),
	(42, 'Categories', 'Route', 'AdminCategoriesControllerGetIndex', 'normal', 'fa fa-tags', 0, 0, 0, 1, 22, '2017-12-21 14:03:36', NULL, NULL),
	(45, 'Quotes', 'Route', 'AdminOrdersControllerGetIndex', 'normal', 'fa fa-edit', 0, 0, 0, 1, 2, '2017-12-21 14:03:37', '2018-02-24 20:54:19', NULL),
	(46, 'Products', 'Route', 'AdminProductsControllerGetIndex', 'normal', 'fa fa-product-hunt', 64, 0, 0, 1, 1, '2017-12-21 14:03:37', '2018-02-19 07:59:20', NULL),
	(47, 'Products Stock', 'Route', 'AdminProductsStockControllerGetIndex', 'normal', 'fa fa-cube', 0, 0, 0, 1, 23, '2017-12-21 14:03:37', NULL, NULL),
	(48, 'Suppliers', 'Route', 'AdminSuppliersControllerGetIndex', 'normal', 'fa fa-user-secret', 0, 0, 0, 1, 6, '2017-12-21 14:03:37', '2017-12-21 17:45:13', NULL),
	(50, 'Leads', 'Route', 'AdminLeadsControllerGetIndex', 'normal', 'fa fa-user', 0, 1, 0, 1, 2, '2017-12-21 14:55:06', '2018-06-09 14:48:30', NULL),
	(53, 'Appliances', 'URL', '#', 'aqua', 'fa fa-th-list', 0, 0, 0, 1, 18, '2018-01-07 20:23:50', '2018-01-07 20:25:28', NULL),
	(54, 'Stock', 'URL', '#', 'aqua', 'fa fa-product-hunt', 0, 0, 0, 1, 17, '2018-01-07 20:24:29', '2018-01-07 20:24:52', NULL),
	(55, 'Appliance Categories', 'Route', 'AdminAppliancesCategoriesControllerGetIndex', 'normal', 'fa fa-glass', 78, 0, 0, 1, 2, '2018-01-07 20:29:09', '2018-02-09 07:46:01', NULL),
	(56, 'Appliance Inside', 'Route', 'AdminAppliancesInsideControllerGetIndex', 'normal', 'fa fa-clock-o', 78, 0, 0, 1, 1, '2018-01-07 20:32:09', '2018-02-19 07:55:06', NULL),
	(57, 'Appliances', 'Route', 'AdminAppliancesControllerGetIndex', NULL, 'fa fa-th-list', 0, 0, 0, 1, 24, '2018-01-07 20:39:21', NULL, NULL),
	(58, 'Email Campaigns Settings', 'Route', 'AdminSettingsCampaignsControllerGetIndex', 'normal', 'fa fa-envelope', 0, 0, 0, 1, 11, '2018-01-10 21:57:27', '2018-01-11 19:38:07', NULL),
	(59, 'Campaigns', 'URL', '#', 'aqua', 'fa fa-list-alt', 0, 0, 0, 1, 15, '2018-01-10 22:04:58', NULL, NULL),
	(61, 'Campaigns', 'Route', 'AdminCampaignsControllerGetIndex', 'normal', 'fa fa-envelope-o', 0, 1, 0, 1, 4, '2018-01-11 17:31:27', '2018-02-09 07:48:54', NULL),
	(62, 'Clients', 'Route', 'AdminClientsControllerGetIndex', 'normal', 'fa fa-user-plus', 0, 1, 0, 1, 3, '2018-01-11 19:42:24', '2018-06-10 09:00:08', NULL),
	(63, 'Lead Type', 'Route', 'AdminCustomerType1ControllerGetIndex', 'normal', 'fa fa-user-secret', 0, 0, 0, 1, 10, '2018-01-29 18:36:37', '2018-02-02 17:02:02', NULL),
	(64, 'General Settings', 'URL', '#', 'aqua', 'fa fa-cog', 0, 0, 0, 1, 7, '2018-01-29 18:38:25', '2018-01-29 21:43:25', NULL),
	(65, 'Notes', 'Route', 'AdminNotesControllerGetIndex', 'normal', 'fa fa-sticky-note', 0, 0, 0, 1, 1, '2018-01-29 19:37:27', '2018-06-10 21:48:27', NULL),
	(67, 'Task', 'Route', 'AdminEazyTasks1ControllerGetIndex', NULL, 'fa fa-calendar-minus-o', 0, 0, 0, 1, 25, '2018-01-29 21:12:16', NULL, NULL),
	(68, 'Invoices', 'Route', 'AdminInvoices30ControllerGetIndex', 'normal', 'fa fa-credit-card', 0, 0, 0, 1, 3, '2018-01-29 21:32:40', '2018-02-09 08:06:57', NULL),
	(69, 'Invoice Information', 'Route', 'AdminSettings31ControllerGetIndex', 'normal', 'fa fa-credit-card', 0, 0, 0, 1, 8, '2018-01-29 21:42:10', '2018-02-09 08:05:54', NULL),
	(70, 'Products Type', 'Route', 'AdminProductsTypeControllerGetIndex', NULL, 'fa fa-product-hunt', 78, 0, 0, 1, 1, '2018-02-02 05:12:50', NULL, NULL),
	(71, 'Notes Quotes', 'Route', 'AdminNotesQuotesControllerGetIndex', NULL, 'fa fa-glass', 0, 0, 0, 1, 20, '2018-02-04 02:57:06', NULL, NULL),
	(72, 'Notes Phases', 'Route', 'AdminNotesFasesControllerGetIndex', NULL, 'fa fa-sticky-note-o', 0, 0, 0, 1, 19, '2018-02-06 06:07:38', NULL, NULL),
	(73, 'Phases', 'Route', 'AdminFasesControllerGetIndex', 'normal', 'fa fa-clock-o', 64, 0, 0, 1, 2, '2018-02-06 06:10:32', '2018-02-19 07:46:33', NULL),
	(74, 'Phase Description', 'Route', 'AdminFasesTypeControllerGetIndex', 'normal', 'fa fa-clock-o', 0, 0, 0, 1, 13, '2018-02-06 07:05:00', '2018-02-19 07:35:57', NULL),
	(77, 'E', 'Route', 'AdminEazyTasksQuotesControllerGetIndex', NULL, 'fa fa-glass', 0, 0, 0, 1, 16, '2018-02-11 07:02:11', NULL, NULL),
	(78, 'Products', 'URL', '#', 'normal', 'fa fa-product-hunt', 0, 0, 0, 1, 14, '2018-02-12 05:51:09', NULL, NULL),
	(79, 'Charts', 'URL', '/crm/wizard', 'normal', 'fa fa-bar-chart-o', 0, 1, 0, 1, 1, '2018-02-12 06:18:57', '2018-03-20 18:01:06', NULL),
	(84, 'Leads', 'Route', 'AdminCustomersControllerGetIndex', 'normal', 'fa fa-user', 0, 1, 0, 5, 2, '2018-02-19 19:04:35', NULL, NULL),
	(85, 'Quotes', 'Route', 'AdminOrdersControllerGetIndex', 'normal', 'fa fa-shopping-bag', 0, 1, 0, 5, 3, '2018-02-19 19:07:16', NULL, NULL),
	(86, 'Clients', 'Route', 'AdminCustomers25ControllerGetIndex', 'normal', 'fa fa-users', 0, 1, 0, 5, 4, '2018-02-19 19:07:31', NULL, NULL),
	(87, 'Invoices', 'Route', 'AdminInvoices30ControllerGetIndex', 'normal', 'fa fa-credit-card', 0, 1, 0, 5, 5, '2018-02-19 19:07:43', NULL, NULL),
	(88, 'Campaigns', 'Route', 'AdminCampaignsControllerGetIndex', 'normal', 'fa fa-envelope-o', 0, 1, 0, 5, 6, '2018-02-19 19:08:11', '2018-02-19 19:50:50', NULL),
	(89, 'Menu Management', 'Route', 'MenusControllerGetIndex', 'normal', 'fa fa-bars', 91, 1, 0, 5, 3, '2018-02-19 19:49:26', NULL, NULL),
	(90, 'Statistic Builder', 'Route', 'StatisticBuilderControllerGetIndex', 'normal', 'fa fa-dashboard', 0, 0, 0, 5, 11, '2018-02-19 19:50:21', NULL, NULL),
	(91, 'Configuration', 'URL', '#', 'normal', 'fa fa-gear', 0, 1, 0, 5, 7, '2018-02-19 19:52:15', NULL, NULL),
	(92, 'Charts', 'URL', '/crm/wizard', 'normal', 'fa fa-bar-chart-o', 0, 1, 0, 5, 1, '2018-02-19 19:56:12', '2018-03-17 17:58:44', NULL),
	(93, 'Campaigns Emails Settings', 'Route', 'AdminSettingsCampaignsControllerGetIndex', 'normal', 'fa fa-envelope-o', 91, 1, 0, 5, 1, '2018-02-19 19:57:52', NULL, NULL),
	(94, 'Email Template', 'Route', 'EmailTemplatesControllerGetIndex', 'normal', 'fa fa-envelope-o', 91, 1, 0, 5, 2, '2018-02-19 20:02:47', NULL, NULL),
	(95, 'Sizes', 'Route', 'AdminSizesControllerGetIndex', NULL, 'fa fa-tags', 0, 0, 0, 1, 12, '2018-02-20 07:25:05', NULL, NULL),
	(96, 'FRYER  PITCO', 'Module', 'appliances_categories', 'normal', '', 0, 0, 0, 5, 10, '2018-05-17 16:02:15', NULL, NULL),
	(97, 'Appliances', 'Route', 'AdminAppliancesInsideControllerGetIndex', 'normal', 'fa fa-th-list', 0, 0, 0, 5, 1, '2018-05-25 15:07:12', NULL, NULL),
	(98, 'Appliances Categories', 'Route', 'AdminAppliancesCategoriesControllerGetIndex', 'normal', 'fa fa-glass', 0, 0, 0, 5, 2, '2018-05-25 15:07:13', NULL, NULL),
	(99, 'Appliances Inside', 'Route', 'AdminAppliancesControllerGetIndex', 'normal', 'fa fa-glass', 0, 0, 0, 5, 4, '2018-05-25 15:07:13', NULL, NULL),
	(100, 'Products', 'Route', 'AdminProductsControllerGetIndex', 'normal', 'fa fa-cubes', 0, 0, 0, 5, 3, '2018-05-25 15:07:13', NULL, NULL),
	(101, 'Products Stock', 'Route', 'AdminProductsStockControllerGetIndex', 'normal', 'fa fa-cube', 0, 0, 0, 5, 5, '2018-05-25 15:07:13', NULL, NULL),
	(102, 'Products Type', 'Route', 'AdminProductsTypeControllerGetIndex', 'normal', 'fa fa-product-hunt', 0, 0, 0, 5, 6, '2018-05-25 15:07:13', NULL, NULL),
	(103, 'Tasks', 'Route', 'AdminEazyTasks1ControllerGetIndex', 'normal', 'fa fa-calendar-minus-o', 0, 0, 0, 5, 7, '2018-05-25 15:07:13', NULL, NULL),
	(104, 'Tasks Quotes', 'Route', 'AdminEazyTasksQuotesControllerGetIndex', 'normal', 'fa fa-glass', 0, 0, 0, 5, 8, '2018-05-25 15:07:14', NULL, NULL),
	(106, 'Proyects', 'Route', 'AdminProyectsControllerGetIndex', NULL, 'fa fa-folder-open', 0, 0, 0, 1, 5, '2018-06-01 10:23:48', NULL, NULL),
	(107, 'Campañas Automatizadas', 'Route', 'AdminCampaignAutomationsControllerGetIndex', NULL, 'fa fa-calendar-plus-o', 0, 0, 0, 1, 4, '2018-06-05 12:47:13', NULL, NULL),
	(108, 'Business', 'Route', 'AdminBusinessControllerGetIndex', NULL, 'fa fa-briefcase', 0, 1, 0, 1, 5, '2018-06-10 13:45:50', NULL, NULL),
	(109, 'Stages', 'Route', 'AdminStagesControllerGetIndex', NULL, 'fa fa-clock-o', 111, 1, 0, 1, 1, '2018-06-10 14:22:10', NULL, NULL),
	(110, 'Stages\'s Group', 'Route', 'AdminStagesGroupsControllerGetIndex', NULL, 'fa fa-clock-o', 111, 1, 0, 1, 2, '2018-06-12 13:16:20', NULL, NULL),
	(111, 'Stages', 'URL', '#', 'normal', 'fa fa-clock-o', 0, 1, 0, 1, 6, '2018-07-05 05:46:31', NULL, NULL);
/*!40000 ALTER TABLE `cms_menus` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.cms_moduls
CREATE TABLE IF NOT EXISTS `cms_moduls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_protected` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.cms_moduls: ~43 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_moduls` DISABLE KEYS */;
INSERT INTO `cms_moduls` (`id`, `created_at`, `updated_at`, `name`, `icon`, `deleted_at`, `path`, `table_name`, `controller`, `is_protected`, `is_active`) VALUES
	(1, '2017-03-17 00:49:12', NULL, 'Notifications', 'fa fa-cog', NULL, 'notifications', 'cms_notifications', 'NotificationsController', 1, 1),
	(2, '2017-03-17 00:49:12', NULL, 'Privileges', 'fa fa-cog', NULL, 'privileges', 'cms_privileges', 'PrivilegesController', 1, 1),
	(3, '2017-03-17 00:49:12', NULL, 'Privileges Roles', 'fa fa-cog', NULL, 'privileges_roles', 'cms_privileges_roles', 'PrivilegesRolesController', 1, 1),
	(4, '2017-03-17 00:49:12', NULL, 'Users', 'fa fa-users', NULL, 'users', 'cms_users', 'AdminCmsUsersController', 0, 1),
	(5, '2017-03-17 00:49:12', NULL, 'Settings', 'fa fa-cog', NULL, 'settings', 'cms_settings', 'SettingsController', 1, 1),
	(6, '2017-03-17 00:49:12', NULL, 'Module Generator', 'fa fa-database', NULL, 'module_generator', 'cms_moduls', 'ModulsController', 1, 1),
	(7, '2017-03-17 00:49:12', NULL, 'Menu Management', 'fa fa-bars', NULL, 'menu_management', 'cms_menus', 'MenusController', 0, 1),
	(8, '2017-03-17 00:49:12', NULL, 'Campaigns Template', 'fa fa-envelope-o', NULL, 'email_templates', 'cms_email_templates', 'EmailTemplatesController', 0, 1),
	(9, '2017-03-17 00:49:12', NULL, 'Statistic Builder', 'fa fa-dashboard', NULL, 'statistic_builder', 'cms_statistics', 'StatisticBuilderController', 0, 1),
	(10, '2017-03-17 00:49:12', NULL, 'API Generator', 'fa fa-cloud-download', NULL, 'api_generator', '', 'ApiCustomController', 1, 1),
	(11, '2017-03-17 00:49:12', NULL, 'Logs', 'fa fa-flag-o', NULL, 'logs', 'cms_logs', 'LogsController', 1, 1),
	(12, '2017-03-17 03:37:11', NULL, 'Categories', 'fa fa-tags', NULL, 'categories', 'categories', 'AdminCategoriesController', 0, 0),
	(13, '2017-03-17 04:26:56', NULL, 'Brands', 'fa fa-bars', NULL, 'brands', 'brands', 'AdminBrandsController', 0, 0),
	(15, '2017-03-17 04:29:31', NULL, 'Suppliers', 'fa fa-users', NULL, 'suppliers', 'suppliers', 'AdminSuppliersController', 0, 0),
	(16, '2017-03-17 04:32:21', NULL, 'Products', 'fa fa-cubes', NULL, 'products', 'products', 'AdminProductsController', 0, 0),
	(17, '2017-03-17 08:55:38', NULL, 'Products Stock', 'fa fa-cube', NULL, 'products_stock', 'products_stock', 'AdminProductsStockController', 0, 0),
	(18, '2017-03-17 09:17:02', NULL, 'Quotes', 'fa fa-shopping-bag', NULL, 'orders', 'user_trucks', 'AdminOrdersController', 0, 0),
	(19, '2017-12-21 14:55:06', NULL, 'Leads', 'fa fa-user', NULL, 'leads', 'leads', 'AdminLeadsController', 0, 0),
	(20, '2018-01-07 20:29:09', NULL, 'Appliances Categories', 'fa fa-glass', NULL, 'appliances_categories', 'appliances_categories', 'AdminAppliancesCategoriesController', 0, 0),
	(21, '2018-01-07 20:32:09', NULL, 'Appliances Inside', 'fa fa-glass', NULL, 'appliances_inside', 'appliances_inside', 'AdminAppliancesController', 0, 0),
	(22, '2018-01-07 20:39:20', NULL, 'Appliances', 'fa fa-th-list', NULL, 'appliances', 'appliances', 'AdminAppliancesInsideController', 0, 0),
	(23, '2018-01-10 21:57:27', NULL, 'Campaigns', 'fa fa-envelope-o', NULL, 'settings_campaigns', 'settings_campaigns', 'AdminCampaignsController', 0, 0),
	(25, '2018-01-11 19:42:24', NULL, 'Clients', 'fa fa-user-plus', NULL, 'clients', 'leads', 'AdminClientsController', 0, 0),
	(26, '2018-01-29 18:36:36', NULL, 'Leads Type', 'fa fa-user-secret', NULL, 'customer_type', 'customer_type', 'AdminCustomerType1Controller', 0, 0),
	(27, '2018-01-29 19:37:27', NULL, 'Notes', 'fa fa-sticky-note-o', NULL, 'eazy_notes', 'eazy_notes', 'AdminNotesController', 0, 0),
	(28, '2018-01-29 21:07:34', NULL, 'Tasks Type', 'fa fa-folder-open', '2018-07-09 03:45:22', 'eazy_task_type', 'eazy_task_type', 'AdminEazyTaskType1Controller', 0, 0),
	(29, '2018-01-29 21:12:16', NULL, 'Tasks', 'fa fa-calendar-minus-o', NULL, 'eazy_tasks', 'eazy_tasks', 'AdminEazyTasks1Controller', 0, 0),
	(30, '2018-01-29 21:32:40', NULL, 'Invoices', 'fa fa-credit-card', NULL, 'invoice', 'invoice', 'AdminInvoices30Controller', 0, 0),
	(31, '2018-01-29 21:42:10', NULL, 'Invoice Information', 'fa fa-credit-card', NULL, 'settings31', 'settings', 'AdminSettings31Controller', 0, 0),
	(32, '2018-02-02 05:12:50', NULL, 'Products Type', 'fa fa-product-hunt', NULL, 'products_type', 'products_type', 'AdminProductsTypeController', 0, 0),
	(33, '2018-02-04 02:57:06', NULL, 'Notes Quotes', 'fa fa-glass', NULL, 'notes_quotes', 'notes_quotes', 'AdminNotesQuotesController', 0, 0),
	(34, '2018-02-06 06:07:37', NULL, 'Notes Phases', 'fa fa-sticky-note-o', NULL, 'notes_fases', 'notes_fases', 'AdminNotesFasesController', 0, 0),
	(35, '2018-02-06 06:10:32', NULL, 'Phases', 'fa fa-clock-o', NULL, 'fases', 'fases', 'AdminFasesController', 0, 0),
	(36, '2018-02-06 07:05:00', NULL, 'Phase Type', 'fa fa-clock-o', NULL, 'fases_type', 'fases_type', 'AdminFasesTypeController', 0, 0),
	(37, '2018-02-06 08:50:21', NULL, 'Prueba', 'fa fa-glass', '2018-02-06 08:52:42', 'products37', 'products', 'AdminProducts37Controller', 0, 0),
	(38, '2018-02-11 07:02:11', NULL, 'Tasks Quotes', 'fa fa-glass', NULL, 'eazy_tasks_quotes', 'eazy_tasks_quotes', 'AdminEazyTasksQuotesController', 0, 0),
	(39, '2018-02-20 07:25:05', NULL, 'Sizes', 'fa fa-tags', NULL, 'sizes', 'sizes', 'AdminSizesController', 0, 0),
	(40, '2018-05-27 22:31:06', NULL, 'Tasks Clients', 'fa fa-users', NULL, 'eazy_tasks_clients', 'eazy_tasks_clients', 'AdminEazyTasksClientsController', 0, 0),
	(41, '2018-06-01 10:23:48', NULL, 'Proyects', 'fa fa-folder-open', NULL, 'proyects', 'proyects', 'AdminProyectsController', 0, 0),
	(42, '2018-06-05 12:47:13', NULL, 'Campañas Automatizadas', 'fa fa-calendar-plus-o', NULL, 'campaign_automations', 'campaign_automations', 'AdminCampaignAutomationsController', 0, 0),
	(43, '2018-06-10 13:45:50', NULL, 'Business', 'fa fa-briefcase', NULL, 'business', 'business', 'AdminBusinessController', 0, 0),
	(44, '2018-06-10 14:22:10', NULL, 'Stages', 'fa fa-clock-o', NULL, 'stages', 'stages', 'AdminStagesController', 0, 0),
	(45, '2018-06-12 13:16:20', NULL, 'Stages\'s Group', 'fa fa-clock-o', NULL, 'stages_groups', 'stages_groups', 'AdminStagesGroupsController', 0, 0);
/*!40000 ALTER TABLE `cms_moduls` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.cms_notifications
CREATE TABLE IF NOT EXISTS `cms_notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `id_cms_users` int(11) DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_spanish` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.cms_notifications: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `cms_notifications` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.cms_privileges
CREATE TABLE IF NOT EXISTS `cms_privileges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_superadmin` tinyint(1) DEFAULT NULL,
  `theme_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.cms_privileges: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_privileges` DISABLE KEYS */;
INSERT INTO `cms_privileges` (`id`, `created_at`, `updated_at`, `name`, `is_superadmin`, `theme_color`) VALUES
	(1, '2017-03-17 00:49:12', NULL, 'Super Administrator', 1, 'skin-blue'),
	(5, NULL, NULL, 'Sales', 0, 'skin-blue');
/*!40000 ALTER TABLE `cms_privileges` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.cms_privileges_roles
CREATE TABLE IF NOT EXISTS `cms_privileges_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_visible` tinyint(1) DEFAULT NULL,
  `is_create` tinyint(1) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `is_edit` tinyint(1) DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT NULL,
  `id_cms_privileges` int(11) DEFAULT NULL,
  `id_cms_moduls` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.cms_privileges_roles: ~55 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_privileges_roles` DISABLE KEYS */;
INSERT INTO `cms_privileges_roles` (`id`, `created_at`, `updated_at`, `is_visible`, `is_create`, `is_read`, `is_edit`, `is_delete`, `id_cms_privileges`, `id_cms_moduls`) VALUES
	(27, NULL, NULL, 1, 1, 1, 1, 1, 1, 13),
	(28, NULL, NULL, 1, 1, 1, 1, 1, 1, 12),
	(29, NULL, NULL, 1, 1, 1, 1, 1, 1, 19),
	(30, NULL, NULL, 1, 1, 1, 1, 1, 1, 14),
	(31, NULL, NULL, 1, 1, 1, 1, 1, 1, 18),
	(32, NULL, NULL, 1, 1, 1, 1, 1, 1, 16),
	(33, NULL, NULL, 1, 1, 1, 1, 1, 1, 17),
	(34, NULL, NULL, 1, 1, 1, 1, 1, 1, 15),
	(35, NULL, NULL, 1, 1, 1, 1, 1, 1, 4),
	(36, NULL, NULL, 1, 1, 1, 1, 1, 1, 19),
	(39, NULL, NULL, 1, 1, 1, 1, 1, 1, 20),
	(40, NULL, NULL, 1, 1, 1, 1, 1, 1, 21),
	(41, NULL, NULL, 1, 1, 1, 1, 1, 1, 22),
	(42, NULL, NULL, 1, 1, 1, 1, 1, 1, 23),
	(44, NULL, NULL, 1, 1, 1, 1, 1, 1, 24),
	(45, NULL, NULL, 1, 1, 1, 1, 1, 1, 25),
	(46, NULL, NULL, 1, 1, 1, 1, 1, 1, 26),
	(47, NULL, NULL, 1, 1, 1, 1, 1, 1, 27),
	(48, NULL, NULL, 1, 1, 1, 1, 1, 1, 28),
	(49, NULL, NULL, 1, 1, 1, 1, 1, 1, 29),
	(50, NULL, NULL, 1, 1, 1, 1, 1, 1, 30),
	(51, NULL, NULL, 1, 1, 1, 1, 1, 1, 31),
	(52, NULL, NULL, 1, 1, 1, 1, 1, 1, 32),
	(53, NULL, NULL, 1, 1, 1, 1, 1, 1, 33),
	(54, NULL, NULL, 1, 1, 1, 1, 1, 1, 34),
	(55, NULL, NULL, 1, 1, 1, 1, 1, 1, 35),
	(56, NULL, NULL, 1, 1, 1, 1, 1, 1, 36),
	(57, NULL, NULL, 1, 1, 1, 1, 1, 1, 37),
	(58, NULL, NULL, 1, 1, 1, 1, 1, 1, 38),
	(63, NULL, NULL, 1, 1, 1, 1, 1, 5, 19),
	(64, NULL, NULL, 1, 1, 1, 1, 1, 5, 18),
	(65, NULL, NULL, 1, 1, 1, 1, 1, 5, 25),
	(66, NULL, NULL, 1, 1, 1, 1, 1, 5, 30),
	(67, NULL, NULL, 1, 1, 1, 1, 1, 5, 24),
	(68, NULL, NULL, 1, 1, 1, 1, 1, 5, 7),
	(69, NULL, NULL, 1, 1, 1, 1, 1, 5, 9),
	(70, NULL, NULL, 1, 1, 1, 1, 1, 5, 23),
	(71, NULL, NULL, 1, 1, 1, 1, 1, 5, 8),
	(72, NULL, NULL, 1, 1, 1, 1, 1, 1, 39),
	(73, NULL, NULL, 1, 1, 1, 1, 1, 5, 22),
	(74, NULL, NULL, 1, 1, 1, 1, 1, 5, 20),
	(75, NULL, NULL, 1, 1, 1, 1, 1, 5, 21),
	(76, NULL, NULL, 1, 1, 1, 1, 1, 5, 16),
	(77, NULL, NULL, 1, 1, 1, 1, 1, 5, 17),
	(78, NULL, NULL, 1, 1, 1, 1, 1, 5, 32),
	(79, NULL, NULL, 1, 1, 1, 1, 1, 5, 29),
	(80, NULL, NULL, 1, 1, 1, 1, 1, 5, 38),
	(81, NULL, NULL, 1, 1, 1, 1, 1, 5, 28),
	(82, NULL, NULL, 0, 0, 0, 1, 0, 5, 4),
	(83, NULL, NULL, 1, 1, 1, 1, 1, 1, 40),
	(84, NULL, NULL, 1, 1, 1, 1, 1, 1, 41),
	(85, NULL, NULL, 1, 1, 1, 1, 1, 1, 42),
	(86, NULL, NULL, 1, 1, 1, 1, 1, 1, 43),
	(87, NULL, NULL, 1, 1, 1, 1, 1, 1, 44),
	(88, NULL, NULL, 1, 1, 1, 1, 1, 1, 45);
/*!40000 ALTER TABLE `cms_privileges_roles` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.cms_settings
CREATE TABLE IF NOT EXISTS `cms_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `content_input_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dataenum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `helper` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_setting` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.cms_settings: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_settings` DISABLE KEYS */;
INSERT INTO `cms_settings` (`id`, `created_at`, `updated_at`, `name`, `content`, `content_input_type`, `dataenum`, `helper`, `group_setting`, `label`) VALUES
	(1, '2017-03-17 00:49:12', NULL, 'login_background_color', NULL, 'text', NULL, 'Input hexacode', 'Login Register Style', 'Login Background Color'),
	(2, '2017-03-17 00:49:12', NULL, 'login_font_color', NULL, 'text', NULL, 'Input hexacode', 'Login Register Style', 'Login Font Color'),
	(3, '2017-03-17 00:49:12', NULL, 'login_background_image', 'uploads/2017-12/21b17450f798e299745be2a40990a546.png', 'upload_image', NULL, NULL, 'Login Register Style', 'Login Background Image'),
	(4, '2017-03-17 00:49:12', NULL, 'email_sender', 'support@crudbooster.com', 'text', NULL, NULL, 'Email Setting', 'Email Sender'),
	(5, '2017-03-17 00:49:12', NULL, 'smtp_driver', 'mail', 'select', 'smtp,mail,sendmail', NULL, 'Email Setting', 'Mail Driver'),
	(6, '2017-03-17 00:49:12', NULL, 'smtp_host', '', 'text', NULL, NULL, 'Email Setting', 'SMTP Host'),
	(7, '2017-03-17 00:49:12', NULL, 'smtp_port', '25', 'text', NULL, 'default 25', 'Email Setting', 'SMTP Port'),
	(8, '2017-03-17 00:49:12', NULL, 'smtp_username', '', 'text', NULL, NULL, 'Email Setting', 'SMTP Username'),
	(9, '2017-03-17 00:49:12', NULL, 'smtp_password', '', 'text', NULL, NULL, 'Email Setting', 'SMTP Password'),
	(10, '2017-03-17 00:49:12', NULL, 'appname', 'EazyCRM', 'text', NULL, NULL, 'Application Setting', 'Application Name'),
	(11, '2017-03-17 00:49:12', NULL, 'default_paper_size', 'Legal', 'text', NULL, 'Paper size, ex : A4, Legal, etc', 'Application Setting', 'Default Paper Print Size'),
	(12, '2017-03-17 00:49:12', NULL, 'logo', 'uploads/2017-12/3a81007deb5c69d5c8ee8568abd0effa.jpeg', 'upload_image', NULL, NULL, 'Application Setting', 'Logo'),
	(13, '2017-03-17 00:49:12', NULL, 'favicon', 'uploads/2017-12/ac5941f0cfd4ea8ed89f38feb2ae6dee.jpeg', 'upload_image', NULL, NULL, 'Application Setting', 'Favicon'),
	(14, '2017-03-17 00:49:12', NULL, 'api_debug_mode', 'true', 'select', 'true,false', NULL, 'Application Setting', 'API Debug Mode'),
	(15, '2017-03-17 00:49:12', NULL, 'google_api_key', 'AIzaSyCrycdDwxd9Yi8s-RAdgQrQiYzZVm0Asrs', 'text', NULL, NULL, 'Application Setting', 'Google API Key'),
	(16, '2017-03-17 00:49:12', NULL, 'google_fcm_key', NULL, 'text', NULL, NULL, 'Application Setting', 'Google FCM Key');
/*!40000 ALTER TABLE `cms_settings` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.cms_statistics
CREATE TABLE IF NOT EXISTS `cms_statistics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.cms_statistics: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_statistics` DISABLE KEYS */;
INSERT INTO `cms_statistics` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(3, 'Dashboard', 'hum', '2018-02-06 08:38:53', '2018-02-06 09:51:51');
/*!40000 ALTER TABLE `cms_statistics` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.cms_statistic_components
CREATE TABLE IF NOT EXISTS `cms_statistic_components` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_cms_statistics` int(11) DEFAULT NULL,
  `componentID` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `component_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_name` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sorting` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `config` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.cms_statistic_components: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_statistic_components` DISABLE KEYS */;
INSERT INTO `cms_statistic_components` (`id`, `id_cms_statistics`, `componentID`, `component_name`, `area_name`, `sorting`, `name`, `config`, `created_at`, `updated_at`) VALUES
	(14, 3, '54b020c53f63b5c97b84fe1fdbdf5172', 'smallbox', 'area3', 0, NULL, '{"name":"Total Quotes","icon":"ion-bag","color":"bg-green","link":"#","sql":"select count(*) from orders"}', '2018-02-06 08:46:25', NULL),
	(17, 3, 'bc1718d2c178ce8124d775458ecdcdd3', 'smallbox', 'area4', 0, NULL, '{"name":"Total Sales","icon":"ion-bag","color":"bg-aqua","link":"invoices","sql":"select count(*) from invoice"}', '2018-02-06 09:10:35', NULL),
	(18, 3, 'fb4c2414cb795fe642d27e14327bbf78', 'smallbox', 'area1', 0, NULL, '{"name":"Total Leads","icon":"ion-bag","color":"bg-yellow","link":"customers","sql":"select count(*) from customers where contact_type = 0"}', '2018-02-06 09:12:49', NULL),
	(19, 3, '2dc91694ae9cee40025d49a64767abf7', 'smallbox', 'area2', 0, NULL, '{"name":"Total Clients","icon":"ion-bag","color":"bg-red","link":"customers25","sql":"select count(*) from customers where contact_type = 1"}', '2018-02-06 09:13:42', NULL),
	(20, 3, '74c0f8b6d7ff7ca6e918bee45c85336f', 'chartarea', 'area5', 0, NULL, '{"name":"Quotes by Date","sql":"select date(created_at) as label, count(id) as value from `orders` where is_invoice = 0 group by label","area_name":"Quotes","goals":null}', '2018-02-06 09:20:49', NULL),
	(23, 3, 'ebdf9391beeb7be5f6515c87ce7683c1', 'chartbar', 'area5', 0, NULL, '{"name":"Quotes By Sellers","sql":"select date(created_at) as label, count(cms_users_id) as value from `orders` group by label","area_name":"Seller","goals":null}', '2018-02-06 09:44:29', NULL),
	(24, 3, '17ddf5ca50934d1282766190b6932435', 'chartarea', NULL, 0, 'Untitled', NULL, '2018-02-07 09:29:42', NULL);
/*!40000 ALTER TABLE `cms_statistic_components` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.cms_users
CREATE TABLE IF NOT EXISTS `cms_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_cms_privileges` int(11) DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0.000000',
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0.000000',
  `firma` text COLLATE utf8mb4_unicode_ci,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_birthday` date DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.cms_users: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `cms_users` DISABLE KEYS */;
INSERT INTO `cms_users` (`id`, `created_at`, `updated_at`, `name`, `photo`, `email`, `password`, `id_cms_privileges`, `status`, `deleted_at`, `address`, `password_email`, `fullname`, `latitude`, `longitude`, `firma`, `color`, `date_birthday`, `phone`) VALUES
	(1, NULL, '2018-07-06 16:09:03', 'Super Admin', 'uploads/2018-06/admin.png', 'admin@gmail.com', '$2y$10$WqV4ys55Ci7c3a6kjEpfrusMmJwdL8shXHh4QG42uN1xEOqZBqsSO', 1, 'Active', NULL, NULL, NULL, 'Super Admin', '0.000000', '0.000000', '', 'purple', '2018-06-03', NULL),
	(3, NULL, '2018-07-04 23:40:24', 'Marcelo', 'uploads/2018-06/admin.png', 'lmarcelonovo@gmail.com', '$2y$10$t.lfkXh2VrnOdx4hB697uuMGNtlOaxtTn03GiQM7ANQ3PTSxu7QmC', 1, NULL, NULL, '2501 Karbach St\r\nC', 'Info123', 'Marcelo Novo', '0.000000', '0.000000', '<p>Sincerely,</p><p><br></p><p>Luis Novo<br><br></p><div id="Zm-_Id_-Sgn"><table border="0" cellspacing="0" cellpadding="0" width="485" style="font-size: 15.0225px; background-color: rgb(255, 255, 255); color: rgb(47, 59, 76); font-family: Helvetica, Arial, sans-serif; width: 485px;"><tbody style="font-size: 15.024px;"><tr valign="top" style="font-size: 15.0255px;"><td style="font-size: 15.027px; padding-right: 10px; width: 10px;"><img src="https://s3.amazonaws.com/ucwebapp.wisestamp.com/fee501fa-cade-44dd-b313-74da9f0641e2/ChefUnits3.format_png.resize_200x.png#logo" width="65" height="64.3816067653" alt="photo" style="font-size: 15.0285px; border-radius: 4px; width: 65px; height: auto; max-width: 120px;"><br></td><td style="font-size: 15.027px; border-right: 1px solid rgb(0, 161, 230);"><br></td><td style="font-size: 12px; padding-right: 10px; padding-left: 10px; display: inline-block; text-align: initial; font-stretch: normal; line-height: normal; font-family: Arial; color: rgb(100, 100, 100);"><table border="0" cellspacing="0" cellpadding="0" style="font-size: 12.0012px;"><tbody style="font-size: 12.0024px;"><tr style="font-size: 12.0036px;"><td style="font-size: 12px; display: inline-block; text-align: initial; font-stretch: normal; line-height: normal;"><div><b class="text-color theme-font" style="font-size: 12.0012px;">EZCRM Team</b></div></td></tr><tr style="font-size: 12.0036px;"><td style="font-size: 12px; padding-top: 5px; padding-bottom: 5px; font-stretch: normal; line-height: normal; color: rgb(141, 141, 141);"><span class="size" style="font-size: 12.0012px;"><a href="tel:713-589-2613" style="box-sizing: initial; font-size: 12.0024px; color: rgb(141, 141, 141); display: inline-block;">713-589-2613</a></span>&nbsp;<span class="colour" style="color: rgb(0, 161, 230);"><span class="size" style="font-size: 12.0012px;">|</span></span>&nbsp;<span class="size" style="font-size: 12.0012px;"><a href="tel:9566051776" style="box-sizing: initial; font-size: 12.0024px; color: rgb(141, 141, 141); display: inline-block;">9566051776</a></span></td></tr><tr style="font-size: 12.0036px;"><td style="font-size: 12.0048px; margin-top: 5px;"><a href="http://www.facebook.com/ChefUnits" target="_blank" style="box-sizing: initial; font-size: 12.006px; color: rgb(0, 191, 232);"><img width="16" height="16" src="https://s3.amazonaws.com/images.wisestamp.com/icons_32/facebook.png" style="box-sizing: initial; font-size: 12.0072px; vertical-align: initial; border-radius: 0px; width: 16px; height: 16px;"></a>&nbsp;<a href="http://www.linkedin.com/company/chef-units-llc" target="_blank" style="box-sizing: initial; font-size: 12.006px; color: rgb(0, 191, 232);"><img width="16" height="16" src="https://s3.amazonaws.com/images.wisestamp.com/icons_32/linkedin.png" style="box-sizing: initial; font-size: 12.0072px; vertical-align: initial; border-radius: 0px; width: 16px; height: 16px;"></a>&nbsp;<a href="http://twitter.com/chefunits" target="_blank" style="box-sizing: initial; font-size: 12.006px; color: rgb(0, 191, 232);"><img width="16" height="16" src="https://s3.amazonaws.com/images.wisestamp.com/icons_32/twitter.png" style="box-sizing: initial; font-size: 12.0072px; vertical-align: initial; border-radius: 0px; width: 16px; height: 16px;"></a><br><br></td></tr></tbody></table></td></tr></tbody></table></div><p></p>', 'green', '2017-03-06', '8324348183'),
	(4, NULL, NULL, 'Juan Lopez', NULL, 'juan@gmail.com', '$2y$10$dMxGvJLY01Nok9n7HqAKOeNU8xy5ri.xr1oDlj94L1J7BOcd6I/tm', 1, 'Active', NULL, NULL, NULL, 'Juan Lopez', '0.000000', '0.000000', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `cms_users` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.customer_type
CREATE TABLE IF NOT EXISTS `customer_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf16;

-- Volcando datos para la tabla ezcrmserver.customer_type: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `customer_type` DISABLE KEYS */;
INSERT INTO `customer_type` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Favorite', '2018-01-29 16:46:27', '2018-01-29 16:47:04', NULL),
	(2, 'Junks', '2018-01-29 16:46:36', NULL, NULL),
	(3, 'Lost', '2018-01-29 16:46:42', NULL, NULL),
	(4, 'Normal', '2018-01-29 13:37:25', NULL, NULL);
/*!40000 ALTER TABLE `customer_type` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.eazy_notes
CREATE TABLE IF NOT EXISTS `eazy_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `assign_to_id` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- Volcando datos para la tabla ezcrmserver.eazy_notes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `eazy_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `eazy_notes` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.eazy_tasks
CREATE TABLE IF NOT EXISTS `eazy_tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assign_to_id` int(11) DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.eazy_tasks: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `eazy_tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `eazy_tasks` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.events
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.events: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.jobs: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.leads
CREATE TABLE IF NOT EXISTS `leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `address` varchar(255) DEFAULT '-',
  `latitude` varchar(255) DEFAULT '0.000000',
  `longitude` varchar(255) DEFAULT '0.000000',
  `photo` varchar(255) DEFAULT NULL,
  `is_client` int(11) DEFAULT '0',
  `states_id` int(11) DEFAULT '0',
  `city` varchar(255) DEFAULT '-',
  `is_notes` varchar(3) DEFAULT 'No',
  `subscribed` int(11) DEFAULT '1',
  `cms_users_id` int(11) DEFAULT NULL,
  `leads_type_id` int(11) DEFAULT '0',
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `FK_leads_leads_type` (`leads_type_id`),
  KEY `FK_leads_cms_users` (`cms_users_id`),
  CONSTRAINT `FK_leads_cms_users` FOREIGN KEY (`cms_users_id`) REFERENCES `cms_users` (`id`),
  CONSTRAINT `FK_leads_leads_type` FOREIGN KEY (`leads_type_id`) REFERENCES `leads_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla ezcrmserver.leads: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `leads` DISABLE KEYS */;
INSERT INTO `leads` (`id`, `name`, `lastname`, `email`, `phone`, `address`, `latitude`, `longitude`, `photo`, `is_client`, `states_id`, `city`, `is_notes`, `subscribed`, `cms_users_id`, `leads_type_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Julio', 'Pérez', 'julio@gmail.com', '5555555555', 'Address', '', '', NULL, 0, 5, 'City', 'No', 1, 4, 0, '2018-07-15', NULL, NULL);
/*!40000 ALTER TABLE `leads` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.leads_activities
CREATE TABLE IF NOT EXISTS `leads_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leads_id` int(11) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla ezcrmserver.leads_activities: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `leads_activities` DISABLE KEYS */;
INSERT INTO `leads_activities` (`id`, `leads_id`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'The lead was created by: Super Admin', '2018-07-15 20:23:46', NULL, NULL);
/*!40000 ALTER TABLE `leads_activities` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.leads_type
CREATE TABLE IF NOT EXISTS `leads_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf16;

-- Volcando datos para la tabla ezcrmserver.leads_type: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `leads_type` DISABLE KEYS */;
INSERT INTO `leads_type` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(0, 'Normal', '2018-01-29 13:37:25', NULL, NULL),
	(1, 'Favorite', '2018-01-29 16:46:27', '2018-01-29 16:47:04', NULL),
	(2, 'Junks', '2018-01-29 16:46:36', NULL, NULL),
	(3, 'Lost', '2018-01-29 16:46:42', NULL, NULL);
/*!40000 ALTER TABLE `leads_type` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.migrations: ~38 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2016_08_07_145904_add_table_cms_apicustom', 1),
	(2, '2016_08_07_150834_add_table_cms_dashboard', 1),
	(3, '2016_08_07_151210_add_table_cms_logs', 1),
	(4, '2016_08_07_152014_add_table_cms_privileges', 1),
	(5, '2016_08_07_152214_add_table_cms_privileges_roles', 1),
	(6, '2016_08_07_152320_add_table_cms_settings', 1),
	(7, '2016_08_07_152421_add_table_cms_users', 1),
	(8, '2016_08_07_154624_add_table_cms_moduls', 1),
	(9, '2016_08_17_225409_add_status_cms_users', 1),
	(10, '2016_08_20_125418_add_table_cms_notifications', 1),
	(11, '2016_09_04_033706_add_table_cms_email_queues', 1),
	(12, '2016_09_16_035347_add_group_setting', 1),
	(13, '2016_09_16_045425_add_label_setting', 1),
	(14, '2016_09_17_104728_create_nullable_cms_apicustom', 1),
	(15, '2016_10_01_141740_add_method_type_apicustom', 1),
	(16, '2016_10_01_141846_add_parameters_apicustom', 1),
	(17, '2016_10_01_141934_add_responses_apicustom', 1),
	(18, '2016_10_01_144826_add_table_apikey', 1),
	(19, '2016_11_14_141657_create_cms_menus', 1),
	(20, '2016_11_15_132350_create_cms_email_templates', 1),
	(21, '2016_11_15_190410_create_cms_statistics', 1),
	(22, '2016_11_17_102740_create_cms_statistic_components', 1),
	(23, '2017_03_17_061205_create_categories', 1),
	(24, '2017_03_17_070326_create_products', 1),
	(25, '2017_03_17_070433_create_customers', 1),
	(26, '2017_03_17_070509_create_suppliers', 1),
	(27, '2017_03_17_072724_create_brands', 1),
	(28, '2017_03_17_085044_create_orders', 1),
	(29, '2017_03_17_085104_create_orders_detail', 1),
	(30, '2017_03_17_103826_craete_products_stock', 1),
	(31, '2017_03_17_134426_add_brands_id_to_products', 1),
	(32, '2017_03_17_134848_add_sku_to_products', 1),
	(33, '2017_03_17_145653_add_sku_to_orders_detail', 1),
	(34, '2017_10_20_164021_create_contacts_table', 1),
	(35, '2017_10_22_043941_create_task_type_table', 1),
	(36, '2017_10_22_160110_create_tasks_table', 1),
	(37, '2017_10_31_150214_create_events_table', 1),
	(38, '2017_11_13_191550_create_jobs_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `categories_id` int(11) DEFAULT NULL,
  `suppliers_id` int(11) DEFAULT NULL,
  `sizes_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` double DEFAULT NULL,
  `buy_price` double DEFAULT NULL,
  `sell_price` double NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '0',
  `brands_id` int(11) DEFAULT NULL,
  `sku` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `products_type_id` int(11) DEFAULT NULL,
  `products_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.products: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.products_stock
CREATE TABLE IF NOT EXISTS `products_stock` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `products_id` int(10) unsigned NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `cms_users_id` int(11) DEFAULT NULL,
  `stock_in` int(11) NOT NULL DEFAULT '0',
  `stock_out` int(11) DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `products_stock_products_id_foreign` (`products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.products_stock: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `products_stock` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_stock` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.provider
CREATE TABLE IF NOT EXISTS `provider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla ezcrmserver.provider: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `provider` DISABLE KEYS */;
/*!40000 ALTER TABLE `provider` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `latitude` varchar(255) DEFAULT '0.000000',
  `longitude` varchar(255) DEFAULT '0.000000',
  `sid_twilio` varchar(100) DEFAULT NULL,
  `number_twilio` varchar(100) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `quotes` int(11) DEFAULT '0',
  `tax_buildout` float DEFAULT '0',
  `tax_accesories` float DEFAULT '0',
  `tax_item` float DEFAULT '0',
  `registration` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf16;

-- Volcando datos para la tabla ezcrmserver.settings: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`, `address`, `phone`, `email`, `latitude`, `longitude`, `sid_twilio`, `number_twilio`, `token`, `quotes`, `tax_buildout`, `tax_accesories`, `tax_item`, `registration`) VALUES
	(1, 'Team EZCRM', '2018-01-29 16:58:39', '2018-04-14 09:46:54', NULL, '2501 Karbach St c, Houston, TX 77092', '(713) 589-2613', 'info@chefunits.com', NULL, NULL, 'AC3ed14e10ec16c0cef08f262f4826d411', '18327803582', 'f89b9f79252e0cc11e4ea796b10b96fa', 1645, 6.25, 8.25, 6.25, 500);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.settings_campaigns
CREATE TABLE IF NOT EXISTS `settings_campaigns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_spanish2_ci DEFAULT 'empty',
  `to` text COLLATE utf8_spanish2_ci,
  `subject` varchar(150) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_spanish2_ci,
  `type` varchar(150) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cms_email_templates_id` int(11) DEFAULT NULL,
  `cms_users_id` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT '0',
  `total_sent` int(11) DEFAULT '0',
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- Volcando datos para la tabla ezcrmserver.settings_campaigns: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `settings_campaigns` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings_campaigns` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.stages
CREATE TABLE IF NOT EXISTS `stages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `stages_groups_id` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_stages_stages_groups` (`stages_groups_id`),
  CONSTRAINT `FK_stages_stages_groups` FOREIGN KEY (`stages_groups_id`) REFERENCES `stages_groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla ezcrmserver.stages: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `stages` DISABLE KEYS */;
INSERT INTO `stages` (`id`, `number`, `name`, `stages_groups_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'Waiting Negociation', 1, NULL, NULL, NULL),
	(2, 2, 'Signing Contract', 1, NULL, NULL, NULL),
	(3, 3, 'First Payment', 1, NULL, NULL, NULL),
	(4, 4, 'Design', 1, NULL, NULL, NULL),
	(5, 5, 'Second Payment', 1, NULL, NULL, NULL),
	(6, 6, 'Delivery to Time', 1, NULL, NULL, NULL),
	(7, 7, 'Delivery and third payment', 1, NULL, NULL, NULL);
/*!40000 ALTER TABLE `stages` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.stages_activities
CREATE TABLE IF NOT EXISTS `stages_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stages_id` int(11) DEFAULT NULL,
  `description` text,
  `business_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla ezcrmserver.stages_activities: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `stages_activities` DISABLE KEYS */;
/*!40000 ALTER TABLE `stages_activities` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.stages_groups
CREATE TABLE IF NOT EXISTS `stages_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla ezcrmserver.stages_groups: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `stages_groups` DISABLE KEYS */;
INSERT INTO `stages_groups` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Stage\'s Pipeline 1', '2018-06-12', NULL, NULL);
/*!40000 ALTER TABLE `stages_groups` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.states
CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `abbreviation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf16;

-- Volcando datos para la tabla ezcrmserver.states: ~54 rows (aproximadamente)
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` (`id`, `name`, `abbreviation`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(2, '-No Apply-', 'NA', NULL, NULL, NULL),
	(3, 'ALABAMA', 'AL', NULL, NULL, NULL),
	(4, 'ALASKA', 'AK', NULL, NULL, NULL),
	(5, 'ARIZONA', 'AZ', NULL, NULL, NULL),
	(6, 'ARKANSAS', 'AR', NULL, NULL, NULL),
	(7, 'CALIFORNIA', 'CA', NULL, NULL, NULL),
	(8, 'NORTH CAROLINA', 'NC', NULL, NULL, NULL),
	(9, 'SOUTH CAROLINA', 'SC', NULL, NULL, NULL),
	(10, 'COLORADO', 'CO', NULL, NULL, NULL),
	(11, 'CONNECTICUT', 'CT', NULL, NULL, NULL),
	(12, 'NORTH DAKOTA', 'ND', NULL, NULL, NULL),
	(13, 'SOUTH DAKOTA', 'SD', NULL, NULL, NULL),
	(14, 'DELAWARE', 'DE', NULL, NULL, NULL),
	(15, 'FLORIDA', 'FL', NULL, NULL, NULL),
	(16, 'GEORGIA', 'GA', NULL, NULL, NULL),
	(17, 'HAWAI', 'HI', NULL, NULL, NULL),
	(18, 'IDAHO', 'ID', NULL, NULL, NULL),
	(19, 'ILLINOIS', 'IL', NULL, NULL, NULL),
	(20, 'INDIANA', 'IN', NULL, NULL, NULL),
	(21, 'IOWA', 'IA', NULL, NULL, NULL),
	(22, 'KANSAS', 'KS', NULL, NULL, NULL),
	(23, 'KENTUCKY', 'KY', NULL, NULL, NULL),
	(24, 'LOUISIANA', 'LA', NULL, NULL, NULL),
	(25, 'MAINE', 'ME', NULL, NULL, NULL),
	(26, 'MARYLAND', 'MD', NULL, NULL, NULL),
	(27, 'MASSACHUSETTS', 'MA', NULL, NULL, NULL),
	(28, 'MICHIGAN', 'MI', NULL, NULL, NULL),
	(29, 'MINNESOTA', 'MN', NULL, NULL, NULL),
	(30, 'MISSISSIPPI', 'MS', NULL, NULL, NULL),
	(31, 'MISSOURI', 'MO', NULL, NULL, NULL),
	(32, 'MONTANA', 'MT', NULL, NULL, NULL),
	(33, 'NEBRASKA', 'NE', NULL, NULL, NULL),
	(34, 'NEVADA', 'NV', NULL, NULL, NULL),
	(35, 'NEW JERSEY', 'NJ', NULL, NULL, NULL),
	(36, 'NEW YORK', 'NY', NULL, NULL, NULL),
	(37, 'NEW HAMPSHIRE', 'NH', NULL, NULL, NULL),
	(38, 'NEW MEXICO', 'NM', NULL, NULL, NULL),
	(39, 'OHIO', 'OH', NULL, NULL, NULL),
	(40, 'OKLAHOMA', 'OK', NULL, NULL, NULL),
	(41, 'OREGON', 'OR', NULL, NULL, NULL),
	(42, 'PENNSYLVANIA', 'PA', NULL, NULL, NULL),
	(43, 'RHODE ISLAND', 'RI', NULL, NULL, NULL),
	(44, 'TENNESSEE', 'TN', NULL, NULL, NULL),
	(45, 'TEXAS', 'TX', NULL, NULL, NULL),
	(46, 'UTAH', 'UT', NULL, NULL, NULL),
	(47, 'VERMONT', 'VT', NULL, NULL, NULL),
	(48, 'VIRGINIA', 'VA', NULL, NULL, NULL),
	(49, 'WEST VIRGINIA', 'WV', NULL, NULL, NULL),
	(50, 'WASHINGTON', 'WA', NULL, NULL, NULL),
	(51, 'WISCONSIN', 'WI', NULL, NULL, NULL),
	(52, 'WYOMING', 'WY', NULL, NULL, NULL),
	(53, 'TEXAS (tax no apply)', 'TX-No Tax', NULL, NULL, NULL);
/*!40000 ALTER TABLE `states` ENABLE KEYS */;

-- Volcando estructura para tabla ezcrmserver.suppliers
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_other` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla ezcrmserver.suppliers: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
