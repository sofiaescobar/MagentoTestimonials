<?php
/**
 * Created by PhpStorm.
 * User: fouf
 * Date: 5/22/16
 * Time: 5:59 PM
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("CREATE TABLE IF NOT EXISTS `sofia_testimonials` (
  `testimonial_id` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `user_name` text,
  `title` text,
  `testimonial` text,
  `enabled` tinyint(1) DEFAULT NULL,
  `image` text,
  `date` datetime DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;");

$installer->run("
ALTER TABLE `sofia_testimonials`
  ADD PRIMARY KEY (`testimonial_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);
");

$installer->run("
ALTER TABLE `sofia_testimonials`
  MODIFY `testimonial_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
");
$installer->run("
ALTER TABLE `sofia_testimonials`
  ADD CONSTRAINT `FK_SOFIA_TESTIMONIALS_USER_ID_CUSTOMER_ENTITY_ENTITY_ID` FOREIGN KEY (`user_id`) REFERENCES `customer_entity` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE;
");

$installer->endSetup();