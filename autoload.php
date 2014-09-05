<?php

function __autoload($classe) {
	
	$diretorios = array(
			'Classes/classe',
			'Controladores/',
			'ClassesSQL/classe'			
	);

	foreach ($diretorios as $dir) {
		if (file_exists($dir.$classe.'.php')) {
			include_once $dir.$classe.'php';
			
		} 
		else {
			echo "A classe $classe não existe ";
			echo "Controladores/".$classe.".php <br />";
		}
	}
	
}

?>