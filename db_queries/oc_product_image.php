SELECT `imageid` + <?= $GLOBALS['I2O']['id_offset'] ?> AS `product_image_id `, `imageprodid` + <?= $GLOBALS['I2O']['id_offset'] ?> AS `product_id`, CONCAT( '<?= $GLOBALS['I2O']['images_prefix'] ?>', `imagefile` ) AS `image`, `imagesort` AS `sort_order` FROM `<?= $GLOBALS['I2O']['input_db'] ?>`.`isc_product_images` AS `isc_product_images`