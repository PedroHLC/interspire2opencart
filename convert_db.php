<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body><a href="convert_db.php"><button>Recarregar</button></a><br/><?php error_reporting(E_ALL ^ E_DEPRECATED);
	$GLOBALS['I2O'] = array(
		'store_id' => 0,
		'store_name' => 'Your Store Name',
		'store_url' => 'http://your.store.url/',

		'id_offset' => 17700,
		'language_id' => 2,
		'weight_class_id' => 2,
		'length_class_id' => 1,
		'customer_default_group_id' => 1,
		'images_prefix' => 'interspire_imp/',
		'status_prefix' => '(Importado) ',
		'order_invoice_prefix' => 'INV-IMPT-00',
		'tax_word' => 'Impostos',
		'instock_categ_id' => 5,
		'outstock_categ_id' => 7,
		'instock_status_tag' => 'EM ESTOQUE',

		'output_db' => 'novoopencart_migrado',
		'input_db' => 'velhointerspire',

		'user_roles2groups' => array(
			'admin' => 1
			//Adicionar todas as roles possiveis
		),

		'form2custom' => array(
			'address' => array(
				3 => array(32, 'repl'=>array('s:6:"Física"'=>'i:1','s:6:"Jurídica"'=>'i:2')),
				4 => 34,
				5 => 36,
				6 => 38,
				7 => 40,
				8 => 42
			)
		),

		'fix_mbserializeds' => array(
			array(
				'table'=>'oc_address',
				'key'=>'address_id',
				'selects'=>array('custom_field')
			)
		),

		'conn' => array(
			'host'=>'192.168.1.250',
			'user'=>'root',
			'pass'=>'div@123@12',
			'encoding'=>'utf8'
		),

		'currencys' => array(
			//old => new
			1 => 4
		)
	);

	if (isset($_GET['exec'])) {
		mysql_connect($GLOBALS['I2O']['conn']['host'], $GLOBALS['I2O']['conn']['user'], $GLOBALS['I2O']['conn']['pass']) or die(mysql_error());
		mysql_set_charset($GLOBALS['I2O']['conn']['encoding']);
		mysql_select_db($GLOBALS['I2O']['output_db']) or die(mysql_error());
	}

	print "<h2>Configurações</h2>";
	var_dump($GLOBALS['I2O']);

	print "<h2>Conversão SQL</h2>";
	print "<p>*Deverás renomear usuários de mesmo nome antes de importar!!</p>";
	print '<ul>';
		print '<li><strong>Select Charset</strong><br/><code>SET NAMES '.$GLOBALS['I2O']['conn']['encoding'].';</code></li>';
		print '<li><strong>Select DB</strong><br/><code>USE `'.$GLOBALS['I2O']['output_db'].'`;</code></li>';

		$queries_ls = glob('./db_queries/*.php');
		foreach($queries_ls as $query_file) {
			$target_name = basename ($query_file, '.php');
			$target_table = explode ('$', $target_name, 2)[0];
			print '<li>';
				print '<strong>'.$target_name.'</strong><br/>';

				ob_start();
					print 'INSERT INTO `'.$target_table.'` ';
						require($query_file);
					print ';';
					$final_query = ob_get_contents();
				ob_end_clean();

				print '<code id="query-'.$target_name.'">';
					print $final_query;
				print '</code><br/>';

				if (isset($_GET['exec'], $_GET['table']) and $_GET['exec']=='conv' and (($_GET['table']==$target_name) or ($_GET['table']==$target_table) or ($_GET['table']=='*'))) {
					print '<span style="font-weight:bold;color:red;">Resultado SQL:</span><br/>';
					if ($result = mysql_query($final_query))
						var_dump($result);
					else
						echo mysql_error();
				} else {
					print '<a href="?exec=conv&table='.$target_name.'"><button>Executar</button></a>';
					if ($target_name != $target_table)
						print '<a href="?exec=conv&table='.$target_table.'"><button>Executar todas da tabela</button></a>';
				}
			print '</li>';
		}

		print '<li><strong style="color:darkblue;">TODAS ACIMA</strong><br/><a href="?exec=conv&table=*"><button>Executar</button></a></li>';
	print '</ul>';

	print "<h2>Correções SQL</h2>";
	print "<p>*Deverás renomear usuários de mesmo nome antes de importar!!</p>";
	print '<ul>';
		$fixes_ls = glob('./fixes/*.php');
		foreach($fixes_ls as $fix_file) {
			$target_name = basename ($fix_file, '.php');
			print '<li id="fix-'.$target_name.'">';
				print '<strong>'.$target_name.'</strong><br/>';
				if (isset($_GET['exec'], $_GET['target']) and $_GET['exec']=='fix' and (($_GET['target']==$target_name) or ($_GET['target']=='*'))) {
					print '<span style="font-weight:bold;color:red;">Resultado:</span><br/>';
					require($fix_file);
				} else
					print '<a href="?exec=fix&target='.$target_name.'"><button>Executar</button></a>';
		}
		print '<li><strong style="color:darkblue;">TODAS ACIMA</strong><br/><a href="?exec=fix&target=*"><button>Executar</button></a></li>';
	print '</ul>';
?></body></html>