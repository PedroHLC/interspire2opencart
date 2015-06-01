SELECT `pk_userid` + <?= $GLOBALS['I2O']['id_offset'] ?> AS `user_id`, <?php 
$s = '`userrole`';
foreach ($GLOBALS['I2O']['user_roles2groups'] as $role => $user_group_id) {
	$s = 'REPLACE( '.$s.', \''.$role.'\', '.$user_group_id.' )';
}
print $s;
?> AS ` user_group_id`, `username` AS `username`, `userpass` AS `password`, '' AS `salt`, `userfirstname` AS `firstname`, `userlastname` AS `lastname`, `useremail` AS `email`, '' AS `image`, '' AS `code`, '0.0.0.0' AS `ip`, `userstatus` AS `status`, NOW( ) AS `date_added` FROM `<?= $GLOBALS['I2O']['input_db'] ?>`.`isc_users` AS `isc_users`