<?PHP
$_SETTINGS['dbset']=array(
	'databases'=>array(
				'default'=>array(
						'driver'=>'mysql',
						'server'=>'<%dbhost%>',
						'name'=>'<%dbname%>',
						'username'=>'<%dbuser%>',
						'password'=>'<%dbpassword%>',
						'prefix'=>'<%dbprefix%>',
						'encoding'=>'utf8',
						'init_query'=>array('SET NAMES utf8;')
						)
				)
	);
?>