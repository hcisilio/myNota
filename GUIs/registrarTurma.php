<?php 
	session_start("mynota");
	if ($_SESSION["logado"] <> "true") {
		header("Location: login.php");
	}
	else if ( ($_SESSION["acesso"] == "Gerente") || ($_SESSION["acesso"] == "Administrador") ){
		//acesso permitido	
		$acesso = $_SESSION["acesso"];
	}
	else {
		//acesso negado
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Cadastrar Turma</title>
	   <link rel="stylesheet" type="text/css" href="CSS/estilos.css">
	<link href="CSS/bootstrap.css" rel="stylesheet">	
	<script src="../Ajax/jQuery.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<script>
	function doPost(formName) {
	    var theForm = document.getElementById(formName);
	    theForm.submit();
	}
	</script>
</head>

<body>


	<!-- NavBar -->
	<nav class="navbar navbar-default" role="navigation" id="barra">
		<div class="container-fluid">
			<div class="navbar-header">
				<!-- colocar alguma imagem mynota -->
			</div>
			<div class="collapse navbar-collapse">
			<form action="../Controladores/controlador.php" method="post" name="logout" id="logout">
				<input type="hidden" name="classe" value="Professor">
				<input type="hidden" name="metodo" value="logout">
				<ul class="nav navbar-nav navbar-right">	
					<li> <a href="JavaScript:doPost('turma')"> <img src="Imagens/save.png"> </a></li>				         
				</ul>
			</form>
			</div>
		</div>
	</nav>
	
	<div id="row">
		<!-- menu lateral -->
		<div class="col-md-3 menuLateral">
			<?php include("mainMenu.php"); ?>
		</div>
		<!-- espaçamento -->
		<div class="col-md-1">
		</div>
		<!-- conteúdo -->
		<div class="col-md-7">			
			<form id="turma" action="../Controladores/controlador.php" method="post">
				<input type="hidden" name="classe" value="Turma">
				<input type="hidden" name="metodo" value="inserir">
				<div class="input-group abaixo">
			 		<span class="input-group-addon edits"><span class="glyphicon glyphicon-barcode"></span></span>			 		
					<input class="form-control edits" name="id" id="id" type="text" placeholder="ID da turma" maxlength="10">
			  	</div>
			  	<div class="input-group abaixo">
			  		<span class="input-group-addon edits"><span class="glyphicon glyphicon-user"></span></span>	
			  		<?php
						include("../ClassesSQL/classeProfessorSQL.php");
						$persistir = new ProfessorSQL();
						$lista = $persistir->listarTodos();
						echo "<select name='professor' class=' form-control edits'>";
							for ($i = 0; $i < count($persistir->listarTodos()); $i++) {
								$id = $lista[$i]->getId();
								$nome = $lista[$i]->getNome();
								echo "<option value=$id> $nome </option>";
							} 
						echo "</select>";
					?>	
				</div>
				<div class="input-group abaixo">
			  		<span class="input-group-addon edits"><span class="glyphicon glyphicon-shopping-cart"></span></span>	
			  		<?php
						include("../ClassesSQL/classeCursoSQL.php");
						$persistir = new CursoSQL();
						$lista = $persistir->listarTodos();
						echo "<select name='curso' class=' form-control edits'>";
							for ($i = 0; $i < count($persistir->listarTodos()); $i++) {
								$id = $lista[$i]->getId();
								$descricao = $lista[$i]->getDescricao();
								echo "<option value=$id> $descricao </option>";
							} 
						echo "</select>";
					?>	
				</div>
				<div class="input-group abaixo">
					<span class="input-group-addon">
						<span class="glyphicon"><img src="icons/glyphicons_231_sun.png">
							<input type="checkbox" name="dia[]" value="1" class="edits"> Domingo						
							<input type="checkbox" name="dia[]" value="2" class="edits"> Segunda
							<input type="checkbox" name="dia[]" value="3" class="edits"> Terça
							<input type="checkbox" name="dia[]" value="4" class="edits"> Quarta
							<input type="checkbox" name="dia[]" value="5" class="edits"> Quinta
							<input type="checkbox" name="dia[]" value="6" class="edits"> Sexta
							<input type="checkbox" name="dia[]" value="7" class="edits"> Sábado
						</span>
					</span>					
				</div>	
			</form>			
		</div>
		<!-- sobra -->
		<div class="col-md-1">
		</div>
		
	</div>
	
	<!-- rodapé -->
	<?php include ("rodape.php") ?>

</body>