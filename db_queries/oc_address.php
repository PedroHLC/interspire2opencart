SELECT `shipid` + <?= $GLOBALS['I2O']['id_offset'] ?> AS `address_id`, `shipcustomerid` + <?= $GLOBALS['I2O']['id_offset'] ?> AS `customer_id`, `shipfirstname` AS `firstname`, `shiplastname` AS `lastname`, `shipcompany` AS `company`, `shipaddress1` AS `address_1`, `shipaddress2` AS `address_2`, `shipcity` AS `city`, `shipzip` AS `postcode`, ( SELECT `country_id` FROM `oc_country` WHERE `name` = `shipcountry` LIMIT 1 ) AS `country_id`, ( SELECT `zone_id` FROM `oc_zone` WHERE `name` = `shipstate` LIMIT 1 ) AS `zone_id`, <?php
	$fields = $GLOBALS['I2O']['form2custom']['address'];
	print 'CONCAT(';
		print '\'a:'.(count($fields)).':{\',';
			foreach($fields as $customformid => $formfieldinfo) {
				$formfieldid = is_array($formfieldinfo) ? $formfieldinfo[0] : $formfieldinfo;
				print '\'i:'.($customformid).';\',';
				print 'IF(( SELECT 1 FROM { oj `'.$GLOBALS['I2O']['input_db'].'`.`isc_formsessions` AS `isc_formsessions` LEFT OUTER JOIN `'.$GLOBALS['I2O']['input_db'].'`.`isc_shipping_addresses` AS `isc_shipping_addresses` ON `isc_formsessions`.`formsessionid` = `isc_shipping_addresses`.`shipformsessionid` }, `'.$GLOBALS['I2O']['input_db'].'`.`isc_formfieldsessions` AS `isc_formfieldsessions` WHERE `isc_formfieldsessions`.`formfieldsessioniformsessionid` = `isc_formsessions`.`formsessionid` AND `isc_shipping_addresses`.`shipid` = `shipid` AND `isc_formfieldsessions`.`formfieldfieldid` = '.$formfieldid.' LIMIT 1 ),';
					$s = '( SELECT `isc_formfieldsessions`.`formfieldfieldvalue` FROM { oj `'.$GLOBALS['I2O']['input_db'].'`.`isc_formsessions` AS `isc_formsessions` LEFT OUTER JOIN `'.$GLOBALS['I2O']['input_db'].'`.`isc_shipping_addresses` AS `isc_shipping_addresses` ON `isc_formsessions`.`formsessionid` = `isc_shipping_addresses`.`shipformsessionid` }, `'.$GLOBALS['I2O']['input_db'].'`.`isc_formfieldsessions` AS `isc_formfieldsessions` WHERE `isc_formfieldsessions`.`formfieldsessioniformsessionid` = `isc_formsessions`.`formsessionid` AND `isc_shipping_addresses`.`shipid` = `shipid` AND `isc_formfieldsessions`.`formfieldfieldid` = '.$formfieldid.' LIMIT 1 )';
					if (isset($formfieldinfo['repl'])) foreach ($formfieldinfo['repl'] as $oldval => $newval)
						$s = 'REPLACE( '.$s.', \''.$oldval.'\', \''.$newval.'\' )';
					print $s.',';
					print '\'s:0:""\'';
				print '),';
			}
		print '\'}\'';
	print ')';
?> AS `custom_field` FROM `<?= $GLOBALS['I2O']['input_db'] ?>`.`isc_shipping_addresses` AS `isc_shipping_addresses`