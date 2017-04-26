/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50631
 Source Host           : localhost
 Source Database       : webed_triangle_theme

 Target Server Type    : MySQL
 Target Server Version : 50631
 File Encoding         : utf-8

 Date: 04/26/2017 19:15:07 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `blog_tags`
-- ----------------------------
DROP TABLE IF EXISTS `blog_tags`;
CREATE TABLE `blog_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('activated','disabled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'activated',
  `order` int(11) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_tags_created_by_foreign` (`created_by`),
  KEY `blog_tags_updated_by_foreign` (`updated_by`),
  CONSTRAINT `blog_tags_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `blog_tags_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `blog_tags`
-- ----------------------------
BEGIN;
INSERT INTO `blog_tags` VALUES ('1', 'New', 'new', 'activated', '0', '1', null, '2017-04-19 17:02:12', '2017-04-19 17:02:12'), ('2', 'Hot', 'hot', 'activated', '0', '1', null, '2017-04-19 17:02:17', '2017-04-19 17:02:17'), ('3', 'Creative', 'creative', 'activated', '0', '1', '1', '2017-04-19 17:02:25', '2017-04-19 17:02:35'), ('4', 'Popular', 'popular', 'activated', '0', '1', '1', '2017-04-19 17:03:30', '2017-04-19 17:03:35');
COMMIT;

-- ----------------------------
--  Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('activated','disabled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'activated',
  `order` int(11) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  KEY `categories_created_by_foreign` (`created_by`),
  KEY `categories_updated_by_foreign` (`updated_by`),
  CONSTRAINT `categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `categories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `categories`
-- ----------------------------
BEGIN;
INSERT INTO `categories` VALUES ('1', null, 'Blog', null, 'blog', 'Some articles you may like', null, null, null, 'activated', '0', '1', '1', '2017-04-19 15:53:15', '2017-04-19 16:50:55');
COMMIT;

-- ----------------------------
--  Table structure for `contacts`
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `options` text COLLATE utf8mb4_unicode_ci,
  `status` enum('read','unread') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contacts_updated_by_foreign` (`updated_by`),
  CONSTRAINT `contacts_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `contacts`
-- ----------------------------
BEGIN;
INSERT INTO `contacts` VALUES ('1', 'Client message', 'Tedozi Manson', 'duyphan.developer@gmail.com', null, null, 'E-mail: sgsoftware.net@gmail.com \r\nPhone: +84 915 42 82 02 \r\nFax: +84 93 151 9393', '[]', 'unread', null, '2017-04-16 17:53:58', '2017-04-16 17:53:58'), ('2', 'Client message', 'Tedozi Manson', 'test@test.com', null, null, 'This is testing message', '[]', 'unread', null, '2017-04-16 17:55:55', '2017-04-16 17:55:55');
COMMIT;

-- ----------------------------
--  Table structure for `custom_fields`
-- ----------------------------
DROP TABLE IF EXISTS `custom_fields`;
CREATE TABLE `custom_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `use_for` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `use_for_id` int(10) unsigned NOT NULL,
  `field_item_id` int(10) unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `custom_fields_field_item_id_foreign` (`field_item_id`),
  CONSTRAINT `custom_fields_field_item_id_foreign` FOREIGN KEY (`field_item_id`) REFERENCES `field_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `custom_fields`
-- ----------------------------
BEGIN;
INSERT INTO `custom_fields` VALUES ('1', 'webed-pages', '1', '1', 'text', 'top_title', 'Welcome to WebEd CMS'), ('2', 'webed-pages', '1', '2', 'textarea', 'top_description', 'A CMS based on Laravel. Modular, flexible and scaleable platform.'), ('3', 'webed-pages', '1', '3', 'repeater', 'services_section', '[[{\"field_item_id\":4,\"type\":\"text\",\"slug\":\"title\",\"value\":\"Modular\"},{\"field_item_id\":5,\"type\":\"textarea\",\"slug\":\"description\",\"value\":\"Flexible plugins development\"},{\"field_item_id\":6,\"type\":\"image\",\"slug\":\"icon\",\"value\":\"\\/uploads\\/homepage\\/services\\/icon1.png\"}],[{\"field_item_id\":4,\"type\":\"text\",\"slug\":\"title\",\"value\":\"Up to date technologies\"},{\"field_item_id\":5,\"type\":\"textarea\",\"slug\":\"description\",\"value\":\"We\'re using the latest Laravel version. Everything will be improved day by day.\"},{\"field_item_id\":6,\"type\":\"image\",\"slug\":\"icon\",\"value\":\"\\/uploads\\/homepage\\/services\\/icon2.png\"}],[{\"field_item_id\":4,\"type\":\"text\",\"slug\":\"title\",\"value\":\"Free and always free\"},{\"field_item_id\":5,\"type\":\"textarea\",\"slug\":\"description\",\"value\":\"WebEd is always free. With MIT license, you can do everything you want.\"},{\"field_item_id\":6,\"type\":\"image\",\"slug\":\"icon\",\"value\":\"\\/uploads\\/homepage\\/services\\/icon3.png\"}]]'), ('4', 'webed-pages', '1', '7', 'text', 'tour_title', 'The first time using WebEd?'), ('5', 'webed-pages', '1', '8', 'textarea', 'tour_description', 'Check out our training videos.'), ('6', 'webed-pages', '1', '9', 'text', 'tour_link', 'https://www.youtube.com/channel/UCh7HEqbV3x60Wta1ynExtpA'), ('7', 'webed-pages', '1', '10', 'repeater', 'features_section', '[[{\"field_item_id\":11,\"type\":\"text\",\"slug\":\"title\",\"value\":\"ALIGNMENT\"},{\"field_item_id\":12,\"type\":\"text\",\"slug\":\"description\",\"value\":\"First of all, we know what customers  need and want\"},{\"field_item_id\":13,\"type\":\"image\",\"slug\":\"feature_image\",\"value\":\"\\/uploads\\/homepage\\/services\\/image1.png\"}],[{\"field_item_id\":11,\"type\":\"text\",\"slug\":\"title\",\"value\":\"CONCEPTUALISATION\"},{\"field_item_id\":12,\"type\":\"text\",\"slug\":\"description\",\"value\":\"Based on that understanding, we research and develop  ideas suitable for the customers.\"},{\"field_item_id\":13,\"type\":\"image\",\"slug\":\"feature_image\",\"value\":\"\\/uploads\\/homepage\\/services\\/image2.png\"}],[{\"field_item_id\":11,\"type\":\"text\",\"slug\":\"title\",\"value\":\"IMPLEMENTATION\"},{\"field_item_id\":12,\"type\":\"text\",\"slug\":\"description\",\"value\":\"The product\'s value is the vision and ideas  that we bring to customers.\"},{\"field_item_id\":13,\"type\":\"image\",\"slug\":\"feature_image\",\"value\":\"\\/uploads\\/homepage\\/services\\/image3.png\"}]]'), ('8', 'webed-pages', '1', '14', 'text', 'clients_title', 'Our happy clients'), ('9', 'webed-pages', '1', '15', 'text', 'clients_description', 'Working with us for a long time, and there are what they say about us'), ('10', 'webed-pages', '1', '16', 'repeater', 'clients', '[[{\"field_item_id\":17,\"type\":\"text\",\"slug\":\"name\",\"value\":\"Hearing\"},{\"field_item_id\":18,\"type\":\"text\",\"slug\":\"website\",\"value\":\"\"},{\"field_item_id\":19,\"type\":\"image\",\"slug\":\"logo\",\"value\":\"\\/uploads\\/homepage\\/services\\/client1.png\"}],[{\"field_item_id\":17,\"type\":\"text\",\"slug\":\"name\",\"value\":\"Play Gro\"},{\"field_item_id\":18,\"type\":\"text\",\"slug\":\"website\",\"value\":\"\"},{\"field_item_id\":19,\"type\":\"image\",\"slug\":\"logo\",\"value\":\"\\/uploads\\/homepage\\/services\\/client2.png\"}],[{\"field_item_id\":17,\"type\":\"text\",\"slug\":\"name\",\"value\":\"Beauty\"},{\"field_item_id\":18,\"type\":\"text\",\"slug\":\"website\",\"value\":\"\"},{\"field_item_id\":19,\"type\":\"image\",\"slug\":\"logo\",\"value\":\"\\/uploads\\/homepage\\/services\\/client3.png\"}],[{\"field_item_id\":17,\"type\":\"text\",\"slug\":\"name\",\"value\":\"Mother Care\"},{\"field_item_id\":18,\"type\":\"text\",\"slug\":\"website\",\"value\":\"\"},{\"field_item_id\":19,\"type\":\"image\",\"slug\":\"logo\",\"value\":\"\\/uploads\\/homepage\\/services\\/client4.png\"}],[{\"field_item_id\":17,\"type\":\"text\",\"slug\":\"name\",\"value\":\"Headon\"},{\"field_item_id\":18,\"type\":\"text\",\"slug\":\"website\",\"value\":\"\"},{\"field_item_id\":19,\"type\":\"image\",\"slug\":\"logo\",\"value\":\"\\/uploads\\/homepage\\/services\\/client5.png\"}],[{\"field_item_id\":17,\"type\":\"text\",\"slug\":\"name\",\"value\":\"Avatar\"},{\"field_item_id\":18,\"type\":\"text\",\"slug\":\"website\",\"value\":\"\"},{\"field_item_id\":19,\"type\":\"image\",\"slug\":\"logo\",\"value\":\"\\/uploads\\/homepage\\/services\\/client6.png\"}]]'), ('11', 'webed-pages', '2', '20', 'repeater', 'testimonials', '[[{\"field_item_id\":21,\"type\":\"text\",\"slug\":\"client_name\",\"value\":\"Tedozi Manson\"},{\"field_item_id\":22,\"type\":\"text\",\"slug\":\"description\",\"value\":\"Awesome project!!!\"},{\"field_item_id\":23,\"type\":\"text\",\"slug\":\"link\",\"value\":\"http:\\/\\/sgsoftware.net\"},{\"field_item_id\":24,\"type\":\"image\",\"slug\":\"avatar\",\"value\":\"\\/uploads\\/homepage\\/services\\/profile1.png\"}],[{\"field_item_id\":21,\"type\":\"text\",\"slug\":\"client_name\",\"value\":\"Yuji Watanabe\"},{\"field_item_id\":22,\"type\":\"text\",\"slug\":\"description\",\"value\":\"Awesome CMS!!!\"},{\"field_item_id\":23,\"type\":\"text\",\"slug\":\"link\",\"value\":\"http:\\/\\/sgsoftware.net\"},{\"field_item_id\":24,\"type\":\"image\",\"slug\":\"avatar\",\"value\":\"\\/uploads\\/homepage\\/services\\/profile2.png\"}]]'), ('12', 'webed-pages', '2', '25', 'textarea', 'contacts', 'E-mail: <a href=\"mailto:sgsoftware.net@gmail.com\">sgsoftware.net@gmail.com</a> <br>\nPhone: +84 915 42 82 02 <br>\nFax: +84 93 151 9393 <br>'), ('13', 'webed-pages', '2', '26', 'textarea', 'address', '151 Dien Bien Phu, <br>\nDistrict 1, <br>\nHCMC, <br>\nVietnam'), ('14', 'webed-blog.posts', '4', '27', 'text', 'youtube_url', 'https://www.youtube.com/watch?v=WvjUkUTreks');
COMMIT;

-- ----------------------------
--  Table structure for `field_groups`
-- ----------------------------
DROP TABLE IF EXISTS `field_groups`;
CREATE TABLE `field_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rules` text COLLATE utf8mb4_unicode_ci,
  `status` enum('activated','disabled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `field_groups_created_by_foreign` (`created_by`),
  KEY `field_groups_updated_by_foreign` (`updated_by`),
  CONSTRAINT `field_groups_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `field_groups_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `field_groups`
-- ----------------------------
BEGIN;
INSERT INTO `field_groups` VALUES ('1', 'Homepage', '[[{\"name\":\"page_template\",\"type\":\"==\",\"value\":\"homepage\"}]]', 'activated', '0', null, null, null, null), ('2', 'Footer custom fields', '[[{\"name\":\"page_template\",\"type\":\"==\",\"value\":\"footer_custom_fields\"}]]', 'activated', '0', null, null, null, null), ('3', 'Video', '[[{\"name\":\"webed-blog.posts.post_template\",\"type\":\"==\",\"value\":\"video\"}]]', 'activated', '0', null, null, null, null);
COMMIT;

-- ----------------------------
--  Table structure for `field_items`
-- ----------------------------
DROP TABLE IF EXISTS `field_items`;
CREATE TABLE `field_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `field_group_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `order` int(11) DEFAULT '0',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructions` text COLLATE utf8mb4_unicode_ci,
  `options` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `field_items_field_group_id_foreign` (`field_group_id`),
  KEY `field_items_parent_id_foreign` (`parent_id`),
  CONSTRAINT `field_items_field_group_id_foreign` FOREIGN KEY (`field_group_id`) REFERENCES `field_groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `field_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `field_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `field_items`
-- ----------------------------
BEGIN;
INSERT INTO `field_items` VALUES ('1', '1', null, '1', 'Top title', 'top_title', 'text', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('2', '1', null, '2', 'Top description', 'top_description', 'textarea', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('3', '1', null, '3', 'Services section', 'services_section', 'repeater', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":\"Add service\",\"rows\":null}'), ('4', '1', '3', '1', 'Title', 'title', 'text', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('5', '1', '3', '2', 'Description', 'description', 'textarea', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('6', '1', '3', '3', 'Icon', 'icon', 'image', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('7', '1', null, '4', 'Tour title', 'tour_title', 'text', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('8', '1', null, '5', 'Tour description', 'tour_description', 'textarea', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('9', '1', null, '6', 'Tour link', 'tour_link', 'text', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":\"http:\\/\\/\",\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('10', '1', null, '7', 'Features section', 'features_section', 'repeater', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":\"Add feature\",\"rows\":null}'), ('11', '1', '10', '1', 'Title', 'title', 'text', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('12', '1', '10', '2', 'Description', 'description', 'text', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('13', '1', '10', '3', 'Feature image', 'feature_image', 'image', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('14', '1', null, '8', 'Clients title', 'clients_title', 'text', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('15', '1', null, '9', 'Clients description', 'clients_description', 'text', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('16', '1', null, '10', 'Clients', 'clients', 'repeater', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":\"Add client\",\"rows\":null}'), ('17', '1', '16', '1', 'Name', 'name', 'text', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('18', '1', '16', '2', 'Website', 'website', 'text', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":\"http:\\/\\/\",\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('19', '1', '16', '3', 'Logo', 'logo', 'image', '130x50', '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('20', '2', null, '1', 'Testimonials', 'testimonials', 'repeater', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":\"Add testimonial\",\"rows\":null}'), ('21', '2', '20', '1', 'Client name', 'client_name', 'text', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('22', '2', '20', '2', 'Description', 'description', 'text', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('23', '2', '20', '3', 'Link', 'link', 'text', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":\"http:\\/\\/\",\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('24', '2', '20', '4', 'Avatar', 'avatar', 'image', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}'), ('25', '2', null, '2', 'Contacts', 'contacts', 'textarea', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":\"4\"}'), ('26', '2', null, '3', 'Address', 'address', 'textarea', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":null,\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":\"4\"}'), ('27', '3', null, '1', 'Youtube url', 'youtube_url', 'text', null, '{\"defaultValue\":null,\"defaultValueTextarea\":null,\"placeholderText\":\"http:\\/\\/youtube...\",\"wysiwygToolbar\":null,\"selectChoices\":null,\"buttonLabel\":null,\"rows\":null}');
COMMIT;

-- ----------------------------
--  Table structure for `menu_nodes`
-- ----------------------------
DROP TABLE IF EXISTS `menu_nodes`;
CREATE TABLE `menu_nodes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `related_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_font` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `css_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(10) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_nodes_menu_id_foreign` (`menu_id`),
  KEY `menu_nodes_parent_id_foreign` (`parent_id`),
  CONSTRAINT `menu_nodes_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `menu_nodes_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menu_nodes` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `menu_nodes`
-- ----------------------------
BEGIN;
INSERT INTO `menu_nodes` VALUES ('1', '1', null, '1', 'page', null, 'Homepage', '', '', '', '0', '2017-04-16 13:28:10', '2017-04-19 18:07:17'), ('3', '1', null, '1', 'category', null, 'Blog', '', '', '', '1', '2017-04-19 18:07:17', '2017-04-20 15:14:17');
COMMIT;

-- ----------------------------
--  Table structure for `menus`
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('activated','disabled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'activated',
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_created_by_foreign` (`created_by`),
  KEY `menus_updated_by_foreign` (`updated_by`),
  CONSTRAINT `menus_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `menus_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `menus`
-- ----------------------------
BEGIN;
INSERT INTO `menus` VALUES ('1', 'Main menu', 'main-menu', 'activated', '1', '1', '2017-04-16 13:28:10', '2017-04-16 13:28:10');
COMMIT;

-- ----------------------------
--  Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `migrations`
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES ('1', '2016_08_04_043730_create_users_table', '1'), ('2', '2016_08_04_043732_create_roles_table', '1'), ('3', '2016_08_04_043756_create_settings_table', '1'), ('4', '2016_11_07_102334_create_menus', '1'), ('5', '2016_11_27_120334_create_plugins_table', '1'), ('6', '2016_11_28_015813_create_pages_table', '1'), ('7', '2016_11_29_163613_create_themes_table', '1'), ('8', '2016_12_07_121349_create_view_trackers_table', '1'), ('9', '2017_04_14_073323_create_custom_fields_tables', '1'), ('10', '2017_04_23_112106_create_static_blocks_table', '2'), ('11', '2017_04_25_075346_set_theme_option_to_nullable', '2');
COMMIT;

-- ----------------------------
--  Table structure for `pages`
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('activated','disabled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'activated',
  `order` int(11) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_created_by_foreign` (`created_by`),
  KEY `pages_updated_by_foreign` (`updated_by`),
  CONSTRAINT `pages_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `pages_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `pages`
-- ----------------------------
BEGIN;
INSERT INTO `pages` VALUES ('1', 'Homepage', 'homepage', 'homepage', null, null, null, null, 'activated', '0', '1', '1', '2017-04-16 13:07:08', '2017-04-16 14:06:39'), ('2', 'Footer custom fields', 'footer_custom_fields', 'footer-custom-fields', null, null, null, null, 'disabled', '0', '1', '1', '2017-04-16 16:19:48', '2017-04-16 16:49:59');
COMMIT;

-- ----------------------------
--  Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `permissions`
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `permissions`
-- ----------------------------
BEGIN;
INSERT INTO `permissions` VALUES ('1', 'Access to dashboard', 'access-dashboard', 'webed-core'), ('2', 'System commands', 'use-system-commands', 'webed-core'), ('3', 'View roles', 'view-roles', 'webed-acl'), ('4', 'Create roles', 'create-roles', 'webed-acl'), ('5', 'Edit roles', 'edit-roles', 'webed-acl'), ('6', 'Delete roles', 'delete-roles', 'webed-acl'), ('7', 'View permissions', 'view-permissions', 'webed-acl'), ('8', 'Assign roles', 'assign-roles', 'webed-acl'), ('9', 'View cache management page', 'view-cache', 'webed-caching'), ('10', 'Modify cache', 'modify-cache', 'webed-caching'), ('11', 'Clear cache', 'clear-cache', 'webed-caching'), ('12', 'View custom fields', 'view-custom-fields', 'webed-custom-fields'), ('13', 'Create field group', 'create-field-groups', 'webed-custom-fields'), ('14', 'Edit field group', 'edit-field-groups', 'webed-custom-fields'), ('15', 'Delete field group', 'delete-field-groups', 'webed-custom-fields'), ('16', 'View files', 'elfinder-view-files', 'webed-elfinder'), ('17', 'Upload files', 'elfinder-upload-files', 'webed-elfinder'), ('18', 'Edit files', 'elfinder-edit-files', 'webed-elfinder'), ('19', 'Delete files', 'elfinder-delete-files', 'webed-elfinder'), ('20', 'View menus', 'view-menus', 'webed-menus'), ('21', 'Delete menus', 'delete-menus', 'webed-menus'), ('22', 'Create menus', 'create-menus', 'webed-menus'), ('23', 'Edit menus', 'edit-menus', 'webed-menus'), ('24', 'View plugins', 'view-plugins', 'webed-modules-management'), ('25', 'View pages', 'view-pages', 'webed-pages'), ('26', 'Create pages', 'create-pages', 'webed-pages'), ('27', 'Edit pages', 'edit-pages', 'webed-pages'), ('28', 'Delete pages', 'delete-pages', 'webed-pages'), ('29', 'View settings page', 'view-settings', 'webed-settings'), ('30', 'Edit settings', 'edit-settings', 'webed-settings'), ('31', 'View themes', 'view-themes', 'webed-themes-management'), ('32', 'View theme options', 'view-theme-options', 'webed-themes-management'), ('33', 'Update theme options', 'update-theme-options', 'webed-themes-management'), ('34', 'View users', 'view-users', 'webed-users'), ('35', 'Create users', 'create-users', 'webed-users'), ('36', 'Edit other users', 'edit-other-users', 'webed-users'), ('37', 'Delete users', 'delete-users', 'webed-users'), ('38', 'Force delete users', 'force-delete-users', 'webed-users'), ('39', 'View contact forms', 'view-contact-forms', 'webed-contact-form'), ('40', 'Update contact forms', 'update-contact-forms', 'webed-contact-form'), ('41', 'Delete contact forms', 'delete-contact-forms', 'webed-contact-form'), ('42', 'View posts', 'view-posts', 'webed-blog'), ('43', 'Create posts', 'create-posts', 'webed-blog'), ('44', 'Update posts', 'update-posts', 'webed-blog'), ('45', 'Delete posts', 'delete-posts', 'webed-blog'), ('46', 'View categories', 'view-categories', 'webed-blog'), ('47', 'Create categories', 'create-categories', 'webed-blog'), ('48', 'Update categories', 'update-categories', 'webed-blog'), ('49', 'Delete categories', 'delete-categories', 'webed-blog'), ('50', 'View tags', 'view-tags', 'webed-blog'), ('51', 'Create tags', 'create-tags', 'webed-blog'), ('52', 'Update tags', 'update-tags', 'webed-blog'), ('53', 'Delete tags', 'delete-tags', 'webed-blog');
COMMIT;

-- ----------------------------
--  Table structure for `plugins`
-- ----------------------------
DROP TABLE IF EXISTS `plugins`;
CREATE TABLE `plugins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `installed_version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enabled` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `installed` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `plugins_alias_unique` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `plugins`
-- ----------------------------
BEGIN;
INSERT INTO `plugins` VALUES ('1', 'webed-backup', null, '0', '0'), ('2', 'webed-blog', '3.1.3', '1', '1'), ('3', 'webed-captcha', '3.1.1', '1', '1'), ('4', 'webed-contact-form', '3.1.4', '1', '1'), ('5', 'webed-analytics', null, '0', '0'), ('6', 'webed-ide', null, '0', '0'), ('7', 'webed-blocks', null, '0', '0');
COMMIT;

-- ----------------------------
--  Table structure for `posts`
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_template` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `status` enum('activated','disabled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'activated',
  `category_id` int(10) unsigned DEFAULT NULL,
  `is_featured` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_category_id_foreign` (`category_id`),
  KEY `posts_created_by_foreign` (`created_by`),
  KEY `posts_updated_by_foreign` (`updated_by`),
  CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `posts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `posts_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `posts`
-- ----------------------------
BEGIN;
INSERT INTO `posts` VALUES ('1', 'Test bai viet', null, 'test-bai-viet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', '/uploads/posts/850x400-1.jpg', null, '0', 'activated', '1', '0', '1', '1', '2017-04-19 16:25:33', '2017-04-19 17:26:07'), ('2', 'The standard Lorem Ipsum passage, used since the 1500s', null, 'the-standard-lorem-ipsum-passage-used-since-the-1500s', 'It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&nbsp;<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&nbsp;<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&nbsp;<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '/uploads/posts/850x400-2.jpg', null, '0', 'activated', '1', '1', '1', '1', '2017-04-19 18:05:06', '2017-04-20 14:21:13'), ('3', 'What is Lorem Ipsum?', null, 'what-is-lorem-ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '/uploads/posts/850x400-3.jpg', null, '0', 'activated', '1', '1', '1', '1', '2017-04-19 18:06:14', '2017-04-20 14:21:19'), ('4', 'What do you mean?', 'video', 'what-do-you-mean', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'http://img.youtube.com/vi/WvjUkUTreks/maxresdefault.jpg', 'what do you mean,version cai luong,oh yeah,webed cms,good cms,laravel', '0', 'activated', '1', '1', '1', '1', '2017-04-20 12:49:10', '2017-04-20 13:01:38');
COMMIT;

-- ----------------------------
--  Table structure for `posts_categories`
-- ----------------------------
DROP TABLE IF EXISTS `posts_categories`;
CREATE TABLE `posts_categories` (
  `post_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `posts_categories_post_id_category_id_unique` (`post_id`,`category_id`),
  KEY `posts_categories_category_id_foreign` (`category_id`),
  CONSTRAINT `posts_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `posts_categories_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `posts_categories`
-- ----------------------------
BEGIN;
INSERT INTO `posts_categories` VALUES ('1', '1'), ('2', '1'), ('3', '1'), ('4', '1');
COMMIT;

-- ----------------------------
--  Table structure for `posts_tags`
-- ----------------------------
DROP TABLE IF EXISTS `posts_tags`;
CREATE TABLE `posts_tags` (
  `post_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `posts_tags_post_id_tag_id_unique` (`post_id`,`tag_id`),
  KEY `posts_tags_tag_id_foreign` (`tag_id`),
  CONSTRAINT `posts_tags_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `posts_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `blog_tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `posts_tags`
-- ----------------------------
BEGIN;
INSERT INTO `posts_tags` VALUES ('1', '1'), ('2', '1'), ('1', '2'), ('4', '2'), ('1', '3'), ('2', '3'), ('4', '3'), ('3', '4');
COMMIT;

-- ----------------------------
--  Table structure for `roles`
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`),
  KEY `roles_created_by_foreign` (`created_by`),
  KEY `roles_updated_by_foreign` (`updated_by`),
  CONSTRAINT `roles_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `roles_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `roles`
-- ----------------------------
BEGIN;
INSERT INTO `roles` VALUES ('1', 'Super Admin', 'super-admin', null, null, '2017-04-16 12:47:17', '2017-04-16 12:47:17');
COMMIT;

-- ----------------------------
--  Table structure for `roles_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `roles_permissions`;
CREATE TABLE `roles_permissions` (
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `roles_permissions_role_id_permission_id_unique` (`role_id`,`permission_id`),
  KEY `roles_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `roles_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `settings`
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `option_key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_option_key_unique` (`option_key`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `settings`
-- ----------------------------
BEGIN;
INSERT INTO `settings` VALUES ('1', 'default_homepage', '1', '2017-04-16 13:11:49', '2017-04-16 13:11:49'), ('2', 'site_title', '', '2017-04-16 13:11:49', '2017-04-16 13:11:49'), ('3', 'site_logo', '', '2017-04-16 13:11:49', '2017-04-16 13:11:49'), ('4', 'favicon', '', '2017-04-16 13:11:49', '2017-04-16 13:11:49'), ('5', 'main_menu', 'main-menu', '2017-04-16 13:28:20', '2017-04-16 13:28:20'), ('6', 'construction_mode', '0', '2017-04-16 13:43:52', '2017-04-26 12:14:05'), ('7', 'show_admin_bar', '1', '2017-04-16 13:43:52', '2017-04-16 13:43:52'), ('8', 'facebook', 'https://www.facebook.com/duyphan.developer', '2017-04-16 13:46:32', '2017-04-16 13:46:32'), ('9', 'youtube', 'https://www.youtube.com/channel/UC5XqPLFs_eeBu6LU4LZLY6w', '2017-04-16 13:46:32', '2017-04-16 13:46:32'), ('10', 'twitter', '', '2017-04-16 13:46:32', '2017-04-16 13:46:32'), ('11', 'google_plus', '', '2017-04-16 13:46:32', '2017-04-16 13:46:32'), ('12', 'instagram', '', '2017-04-16 13:46:32', '2017-04-16 13:46:32'), ('13', 'linkedin', '', '2017-04-16 13:46:32', '2017-04-16 13:46:32'), ('14', 'flickr', '', '2017-04-16 13:46:32', '2017-04-16 13:46:32'), ('15', 'google_captcha_site_key', '6Ler0xIUAAAAAC7bWMHYHcNsLdEElhNW0Dfuhl8p', '2017-04-16 17:27:37', '2017-04-16 17:27:37'), ('16', 'google_captcha_secret_key', '6Ler0xIUAAAAAC_NuVufXcldntV35d23KxCS4Dmn', '2017-04-16 17:27:37', '2017-04-16 17:27:37');
COMMIT;

-- ----------------------------
--  Table structure for `static_blocks`
-- ----------------------------
DROP TABLE IF EXISTS `static_blocks`;
CREATE TABLE `static_blocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `status` enum('activated','disabled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'activated',
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `static_blocks_created_by_foreign` (`created_by`),
  KEY `static_blocks_updated_by_foreign` (`updated_by`),
  CONSTRAINT `static_blocks_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `static_blocks_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `theme_options`
-- ----------------------------
DROP TABLE IF EXISTS `theme_options`;
CREATE TABLE `theme_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `theme_id` int(10) unsigned NOT NULL,
  `key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `theme_options_theme_id_key_unique` (`theme_id`,`key`),
  CONSTRAINT `theme_options_theme_id_foreign` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `theme_options`
-- ----------------------------
BEGIN;
INSERT INTO `theme_options` VALUES ('1', '2', 'footer_content_page', '2'), ('2', '2', 'items_per_page', '5');
COMMIT;

-- ----------------------------
--  Table structure for `themes`
-- ----------------------------
DROP TABLE IF EXISTS `themes`;
CREATE TABLE `themes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `installed` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `installed_version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `themes_alias_unique` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `themes`
-- ----------------------------
BEGIN;
INSERT INTO `themes` VALUES ('1', 'nongdanviet', '0', '0', null), ('2', 'triangle', '1', '1', '1.0.5');
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activation_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` enum('male','female','other') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'male',
  `status` enum('activated','disabled') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'activated',
  `birthday` datetime DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `last_activity_at` timestamp NULL DEFAULT NULL,
  `disabled_until` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_created_by_foreign` (`created_by`),
  KEY `users_updated_by_foreign` (`updated_by`),
  CONSTRAINT `users_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `users_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'admin', 'admin@webed.com', '$2y$10$g8Q.dKOOYsqfFVxJ3V/XVOpWsyizL99S17i1UWBJ3DGijbWil5cI.', 'Super Admin', 'Admin', '0', null, '/uploads/users/user_avatar.png', '0915428202', '0931519393', 'male', 'activated', '1993-02-25 00:00:00', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliq Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi.', 'WeDIHfLjyZC1vKNW95rMHnNKfV26aeXnu2zBOVtTRSrSX6gIqKvM5wJtkITf', null, null, '2017-04-26 12:13:54', null, null, null, '2017-04-16 12:47:24', '2017-04-26 12:13:54');
COMMIT;

-- ----------------------------
--  Table structure for `users_roles`
-- ----------------------------
DROP TABLE IF EXISTS `users_roles`;
CREATE TABLE `users_roles` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `users_roles_user_id_role_id_unique` (`user_id`,`role_id`),
  KEY `users_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `users_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `users_roles`
-- ----------------------------
BEGIN;
INSERT INTO `users_roles` VALUES ('1', '1');
COMMIT;

-- ----------------------------
--  Table structure for `view_trackers`
-- ----------------------------
DROP TABLE IF EXISTS `view_trackers`;
CREATE TABLE `view_trackers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entity_id` int(10) unsigned NOT NULL,
  `count` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `view_trackers_entity_entity_id_unique` (`entity`,`entity_id`),
  KEY `view_trackers_entity_index` (`entity`),
  KEY `view_trackers_entity_id_index` (`entity_id`),
  KEY `view_trackers_count_index` (`count`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `view_trackers`
-- ----------------------------
BEGIN;
INSERT INTO `view_trackers` VALUES ('1', 'WebEd\\Base\\Pages\\Models\\Page', '1', '368'), ('2', 'WebEd\\Base\\Pages\\Models\\Page', '3', '4'), ('3', 'WebEd\\Plugins\\Blog\\Models\\Category', '1', '80'), ('4', 'WebEd\\Plugins\\Blog\\Models\\Post', '1', '4'), ('5', 'WebEd\\Plugins\\Blog\\Models\\Post', '3', '34'), ('6', 'WebEd\\Plugins\\Blog\\Models\\Post', '2', '1'), ('7', 'WebEd\\Plugins\\Blog\\Models\\Post', '4', '3');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
