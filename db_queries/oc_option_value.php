SELECT <?= $GLOBALS['I2O']['id_offset'] ?> + `voptionid` AS `option_value_id`, <?= $GLOBALS['I2O']['id_offset'] ?> + `vovariationid` AS `option_id`, '' AS `image`, 0 AS `sort_order` FROM `<?= $GLOBALS['I2O']['input_db'] ?>`.`isc_product_variation_options` AS `isc_product_variation_options`