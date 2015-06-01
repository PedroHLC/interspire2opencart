SELECT `brandid` + <?= $GLOBALS['I2O']['id_offset'] ?> AS `manufacturer_id`, `brandname` AS `name`, IF( CHAR_LENGTH ( `brandimagefile` ) > 0, CONCAT( '<?= $GLOBALS['I2O']['images_prefix'] ?>', `brandimagefile` ), '' ) AS `image`, 0 FROM `<?= $GLOBALS['I2O']['input_db'] ?>`.`isc_brands` AS `isc_brands`