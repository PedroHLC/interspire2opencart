SELECT `categoryid` + <?= $GLOBALS['I2O']['id_offset'] ?> AS `category_id`, <?= $GLOBALS['I2O']['language_id'] ?> AS `language_id`, `catname` AS `name`, `catdesc` AS `description`, '' AS `meta_title`, '', `catsearchkeywords` AS `meta_keyword` FROM `<?= $GLOBALS['I2O']['input_db'] ?>`.`isc_categories` AS `isc_categories`