SELECT `pageid` + <?= $GLOBALS['I2O']['id_offset'] ?> AS `information_id`, <?= $GLOBALS['I2O']['language_id'] ?> AS `language_id`, `pagetitle` AS `title`, `pagecontent` AS `description`, `pagemetatitle` AS `meta_title`, `pagemetadesc` AS `meta_description`, `pagemetakeywords` AS `meta_keyword` FROM `<?= $GLOBALS['I2O']['input_db'] ?>`.`isc_pages` AS `isc_pages` WHERE `pagetype` = 0