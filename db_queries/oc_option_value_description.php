SELECT `voptionid` + <?= $GLOBALS['I2O']['id_offset'] ?> AS `option_value_id`, <?= $GLOBALS['I2O']['language_id'] ?> AS `language_id`, `vovariationid` + <?= $GLOBALS['I2O']['id_offset'] ?> AS `option_id`, `vovalue` AS `name` FROM `<?= $GLOBALS['I2O']['input_db'] ?>`.`isc_product_variation_options` AS `isc_product_variation_options`