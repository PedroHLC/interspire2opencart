<?php
	foreach($GLOBALS['I2O']['fix_mbserializeds'] as $target) {
		$selects_prep = '';
		$selects_num = count($target['selects']);
		$i=0;
		foreach ($target['selects'] as $i => $col) {
			$selects_prep .= '`'.$col.'`';
			if (($i+=1) < $selects_num)
				$selects_prep .= ',';
		}
		$table_query = 'SELECT `'.$target['key'].'`,'.$selects_prep.' FROM `'.$target['table'].'`;';
		$get_res = mysql_query($table_query);
		if ($get_res === false) {
			print $table_query;
			print '<br/>';
			die(mysql_error());
		}
		if(mysql_num_rows($get_res)>0) while($row = mysql_fetch_array($get_res)){
			$result_query = 'UPDATE `'.$target['table'].'`';
			$i = 0;
			foreach ($target['selects'] as $skey) {
				$result_query .= ' SET `'.$skey.'`=\'';
				$result_query .= preg_replace_callback(
					'!s:(\d+):"(.*?)";!s',
					function ($matches) {
						if ( isset( $matches[2] ) )
							return 's:'.strlen(utf8_encode($matches[2])).':"'.$matches[2].'";';
					},
					$row[$skey]
				);
				$result_query .= ((($i+=1) < $selects_num) ? '\',' : '\'');
			}
			$result_query .= ' WHERE `'.$target['key'].'`=\''.$row[$target['key']].'\';'."\n";
			$put_res = mysql_query($result_query);
			if ($put_res === false) {
				print utf8_encode($result_query);
				print '<br/>';
				die(mysql_error());
			}
		}
		print '<p>Concluido</p>';
	}
