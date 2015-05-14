<?php
	session_start("mynota");
	include_once ("../Controladores/controladorPermissao.php");
	$persistir = new ControladorPermissao();
	$persistir->autorizarAcesso( end(explode("/", $_SERVER['PHP_SELF'])) );

	//Adicionando os módulos
	if ( (!isset($_SESSION['modulos'])) && (isset($_GET['modulo_add'])) ) {
		$_SESSION['modulos'] = array();
		$_SESSION['modulos'][$_GET['modulo_add']] = $_GET['modulo_add'];
	}
	else if (isset($_GET['modulo_add'])){
		//array_push($_SESSION['modulos'], $_GET['modulo_add']);
		$_SESSION['modulos'][$_GET['modulo_add']] = $_GET['modulo_add'];
	}
	//removendo os módulos
	if (isset($_GET['modulo_del'])){
		unset($_SESSION['modulos'][$_GET['modulo_del']]);
		if ( count($_SESSION['modulos']) == 0 ){
			unset($_SESSION['modulos']);
		}
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Cadastrar Novo Curso</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link href="css/bootstrap.css" rel="stylesheet">	
	<script src="js/jQuery.js"></script>
	<script type="text/javascript" src="js/validacoes.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<script>
		function matricularAluno() {
			if ( nuloOUvazio("#curso") ) {
				$.ajax({			        
					type: "POST",
					url: "../Controladores/controlador.php",
					data: { 
						descricao: $("#descricao").val(),
						classe: "Curso",
						metodo: "inserir"
					},
					success: function(resultado) {
						$('#principal').hide();				
						$('#principal').html(resultado);
						$('#principal').show("slow");	
					},
					error: function(resultado) {				
						
					}
				});
			}
		}
		function incluirCurso(){

		}
	</script>
</head>

<body>

	<!-- NavBar -->
	<nav class="navbar navbar-default" role="navigation" id="barra">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="../GUIs/home.php"> <img alt="Brand" src="Imagens/sublogo_branco.png"> </a>		
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">	
					<li> <a href="JavaScript:matricularAluno()"> <img src="Imagens/save.png"> </a></li>				         
				</ul>
			</div>
		</div>
	</nav>
	
	<div id="row">
		<!-- menu lateral -->
		<div class="col-md-3 menuLateral">
			<?php $persistir->criarMenu() ?>
		</div>
		<!-- espaçamento -->
		<div class="col-md-2">
		</div>
		<!-- conteúdo -->
		<div id="principal" class="abaixo col-md-5">			
			<form id="curso" action="../Controladores/controlador.php" method="post">
				<div class="input-group abaixo">
			 		<span class="input-group-addon edits"><span class="glyphicon glyphicon-pencil"></span></span>
					<input class="form-control edits nuloOUvazio" name="descricao" id="descricao" type="text" placeholder="Descrição do curso">	
			  	</div>
			</form>
			<p>Inserir Módulos:</p>
			<form id="modulos" action="registrarCurso.php" method="GET">
			  	<div class='input-group abaixo'>
			  		<span class="input-group-addon edits"><span class="glyphicon glyphicon-pencil"></span></span>
					<input class="form-control edits nuloOUvazio" name="modulo_add" id="modulo_add" type="text" placeholder="Módulo">
			  		<span class="input-group-btn"><input type='submit' class='btn btn-primary' value='Incluir'></span>
			  	</div>
			</form>
			<p>Módulos:</p>
			<?php
				if (isset($_SESSION['modulos'])) {					
					foreach ($_SESSION['modulos'] as $modulo) {
						echo "
							<li> $modulo </li>
							<form action='registrarCurso.php' method='GET'>
								<input type='hidden' name='modulo_del' id='modulo_del' value='$modulo'>
								<input type='submit' value='X'>
							</form>
							";
					}
				}
				else {
					echo "Não há módulos";
				}			
			?>
		</div>
		<!-- sobra -->
		<div class="col-md-2">
		</div>
		
	</div>
	
	<!-- rodapé -->
	<?php include ("rodape.php") ?>

</body>