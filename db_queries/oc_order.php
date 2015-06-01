SELECT `isc_orders`.`orderid` + <?= $GLOBALS['I2O']['id_offset'] ?> AS `order_id`, 0 AS `invoice_no`, '<?= $GLOBALS['I2O']['order_invoice_prefix'] ?>' AS `invoice_prefix`, <?= $GLOBALS['I2O']['store_id'] ?> AS `store_id`, '<?= $GLOBALS['I2O']['store_name'] ?>' AS `store_name`, '<?= $GLOBALS['I2O']['store_url'] ?>' AS `store_url`, `ordcustid` + <?= $GLOBALS['I2O']['id_offset'] ?> AS `customer_id`, `isc_customers`.`custgroupid` AS `customer_group_id`, `isc_customers`.`custconfirstname` AS `firstname`, `isc_customers`.`custconlastname` AS `lastname`, `isc_orders`.`ordbillemail` AS `email`, `isc_orders`.`ordbillphone` AS `telephone`, '' AS ` fax`, 'a:0:{}' AS `custom_field`, `isc_orders`.`ordbillfirstname` AS `payment_firstname`, `isc_orders`.`ordbilllastname` AS `payment_lastname`, `isc_orders`.`ordbillcompany` AS `payment_company`, `isc_orders`.`ordbillstreet1` AS `payment_address_1`, `isc_orders`.`ordbillstreet2` AS `payment_address_2`, `isc_orders`.`ordbillsuburb` AS `payment_city`, `isc_orders`.`ordbillzip` AS `payment_postcode`, `isc_orders`.`ordbillcountry` AS `payment_country`, ( SELECT `country_id` FROM `oc_country` WHERE `name` = `ordbillcountry` LIMIT 1 ) AS `payment_country_id`, `isc_orders`.`ordbillstate` AS `payment_zone`, ( SELECT `zone_id` FROM `oc_zone` WHERE `name` = `ordbillstateid` LIMIT 1 ) AS `payment_zone_id`, '' AS `payment_address_format`, 'b:0;' AS `payment_custom_field`, `isc_orders`.`orderpaymentmethod` AS `payment_method`, `isc_orders`.`ordpayproviderid` AS `payment_method`, `isc_orders`.`ordshipfirstname` AS `shipping_firstname`, `isc_orders`.`ordshiplastname` AS `shipping_lastname`, `isc_orders`.`ordshipcompany` AS `shipping_company`, `isc_orders`.`ordshipstreet1` AS `shipping_address_1`, `isc_orders`.`ordbillstreet2` AS `shipping_address_2`, `isc_orders`.`ordshipsuburb` AS `shipping_city`, `isc_orders`.`ordshipzip` AS `shipping_postcode`, `isc_orders`.`ordshipcountry` AS `shipping_country`, ( SELECT `country_id` FROM `oc_country` WHERE `name` = `ordshipcountry` LIMIT 1 ) AS ` shipping_country_id`, `isc_orders`.`ordshipstate` AS `shipping_zone`, ( SELECT `zone_id` FROM `oc_zone` WHERE `name` = `ordshipstate` LIMIT 1 ) AS `shipping_zone_id`, '' AS `shipping_address_format`, 'b:0;' AS `shipping_custom_field`, `isc_orders`.`ordshipmethod` AS `shipping_method`, '' AS `shipping_code`, `isc_orders`.`ordnotes` AS `comment`, `isc_orders`.`ordtotalamount`+`ordtaxtotal` AS `total`, `ordstatus` + <?= $GLOBALS['I2O']['id_offset'] ?> AS `order_status_id`, 0 AS `affiliate_id`, 0 AS `commission`, 0 AS `marketing_id`, `isc_orders`.`ordtrackingno` AS `tracking`, <?= $GLOBALS['I2O']['language_id'] ?> AS `language_id`, <?php
	$s = 'CONCAT( \' \', `isc_orders`.`ordcurrencyid`, \' \' )';
	foreach ($GLOBALS['I2O']['currencys'] as $oldval => $newval)
		$s = 'REPLACE( '.$s.', \' '.$oldval.' \', \''.$newval.'\' )';
	print $s;
?> AS `currency_id`, ( SELECT `code` FROM `oc_currency` WHERE `currency_id` = `currency_id` LIMIT 1 ) AS `currency_code`, `isc_orders`.`ordcurrencyexchangerate` AS `currency_value`, `isc_orders`.`ordipaddress` AS `ip`, '' AS `forwarded_ip`, '' AS `user_agent`, '' AS `accept_language`, FROM_UNIXTIME( `orddate` ) AS `date_added`, FROM_UNIXTIME( `ordlastmodified` ) AS `date_modified` FROM { oj `<?= $GLOBALS['I2O']['input_db'] ?>`.`isc_orders` AS `isc_orders` LEFT OUTER JOIN `<?= $GLOBALS['I2O']['input_db'] ?>`.`isc_customers` AS `isc_customers` ON `isc_orders`.`ordcustid` = `isc_customers`.`customerid` }