SELECT ( ( `orderid` - 1 ) * 4 ) + <?= $GLOBALS['I2O']['id_offset']+3 ?> AS `order_total_id`, `orderid` + <?= $GLOBALS['I2O']['id_offset'] ?> AS `order_id`, 'tax' AS `code`, '<?= $GLOBALS['I2O']['tax_word'] ?>' AS `title`, `ordtaxtotal` AS `value`, 8 AS `sort_order` FROM `<?= $GLOBALS['I2O']['input_db'] ?>`.`isc_orders` AS `isc_orders` WHERE `ordtaxtotal` > 0