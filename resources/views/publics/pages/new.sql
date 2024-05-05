CREATE TABLE `par_address_info` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `address_icon_id` bigint unsigned NOT NULL,
    `street_address_name` varchar(2000),
    `city` varchar(100) DEFAULT NULL,
    `country` varchar(255) DEFAULT NULL,
    `created_by` varchar(50) DEFAULT NULL,
    `created_at` varchar(50) DEFAULT NULL,
    `updated_by` varchar(50) DEFAULT NULL,
    `updated_at` varchar(50) DEFAULT NULL,
    `altered_by` varchar(50) DEFAULT NULL,
    `altered_on` varchar(50) DEFAULT NULL,
    CONSTRAINT `par_address_info_address_icon_id_foreign` FOREIGN KEY (`address_icon_id`) REFERENCES `par_icons` (`id`) ON DELETE CASCADE
);

-- Optional: If you want to drop the table in the down migration
DROP TABLE IF EXISTS `par_contact_info`;


CREATE TABLE `par_contact_info` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `phone_icon_id` bigint unsigned NOT NULL,
    `company_phone_number` varchar(100) DEFAULT NULL,
    `created_by` varchar(50) DEFAULT NULL,
    `created_at` varchar(50) DEFAULT NULL,
    `updated_by` varchar(50) DEFAULT NULL,
    `updated_at` varchar(50) DEFAULT NULL,
    `altered_by` varchar(50) DEFAULT NULL,
    `altered_on` varchar(50) DEFAULT NULL,
    CONSTRAINT `par_contact_info_phone_icon_id_foreign` FOREIGN KEY (`phone_icon_id`) REFERENCES `par_icons` (`id`) ON DELETE CASCADE
);



CREATE TABLE `par_email_info` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `email_icon_id` bigint unsigned NOT NULL,
    `company_email` varchar(255) DEFAULT NULL,
    `created_by` varchar(50) DEFAULT NULL,
    `created_at` varchar(50) DEFAULT NULL,
    `updated_by` varchar(50) DEFAULT NULL,
    `updated_at` varchar(50) DEFAULT NULL,
    `altered_by` varchar(50) DEFAULT NULL,
    `altered_on` varchar(50) DEFAULT NULL,
    CONSTRAINT `par_email_info_email_icon_id_foreign` FOREIGN KEY (`email_icon_id`) REFERENCES `par_icons` (`id`) ON DELETE CASCADE,
);


CREATE TABLE `par_services_info` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `service_icon_id` bigint unsigned NOT NULL,
    `name` varchar(255) DEFAULT NULL,
    `description` varchar(255) DEFAULT NULL,
    `created_by` varchar(50) DEFAULT NULL,
    `created_at` varchar(50) DEFAULT NULL,
    `updated_by` varchar(50) DEFAULT NULL,
    `updated_at` varchar(50) DEFAULT NULL,
    `altered_by` varchar(50) DEFAULT NULL,
    `altered_on` varchar(50) DEFAULT NULL,
    CONSTRAINT `par_services_info_service_icon_id_foreign` FOREIGN KEY (`service_icon_id`) REFERENCES `par_icons` (`id`) ON DELETE CASCADE,
);


INSERT INTO `par_icons` (`id`, `name`, `description`, `code`, `is_enabled`, `icon`, `created_by`, `created_at`, `updated_by`, `updated_at`, `altered_by`, `altered_on`) VALUES
 ('11', 'Web Development', 'Web Development', '', NULL, 'fa fa-code', 'Admin', NULL, NULL, NULL, NULL, NULL),
 ('12', 'Apps Development', 'Apps Development', NULL, NULL, 'fab fa-android', 'Admin', NULL, NULL, NULL, NULL, NULL);
  ('13', 'SEO Optimization', 'SEO Optimization', '', NULL, 'fa fa-search', 'Admin', NULL, NULL, NULL, NULL, NULL),


CREATE TABLE `par_patners_info` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `partner_icon_id` bigint unsigned NOT NULL,
    `name` varchar(255) DEFAULT NULL,
    `description` varchar(255) DEFAULT NULL,
    `created_by` varchar(50) DEFAULT NULL,
    `created_at` varchar(50) DEFAULT NULL,
    `updated_by` varchar(50) DEFAULT NULL,
    `updated_at` varchar(50) DEFAULT NULL,
    `altered_by` varchar(50) DEFAULT NULL,
    `altered_on` varchar(50) DEFAULT NULL,
    CONSTRAINT `par_patners_info_partner_icon_id_foreign` FOREIGN KEY (`partner_icon_id`) REFERENCES `par_icons` (`id`) ON DELETE CASCADE,
);
