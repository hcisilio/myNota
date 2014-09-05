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
<link rel="stylesheet" type="text/css" href="CSS/mynota.css">
<script>
function doPost(formName) {
    var theForm = document.getElementById(formName);
    theForm.submit();
}
</script>
</head>

<body>

	<div id="principal">

		<div id="topo">
			Topo da página
		</div>
		
		<div id="barra">
			<ul>
				<li> <a href="JavaScript:doPost('turma')"> <img src="Imagens/save.png"> </a></li>        
			</ul>
		</div>
		
		<div id="menu">
			<?php include("mainMenu.php"); ?>
		</div>

		<div id="formulario">
				<form id="turma" action="../Controladores/controlador.php" method="post">
				<input type="hidden" name="classe" value="Turma">
				<input type="hidden" name="metodo" value="inserir">
				<label> ID da turma </label> <br>
				<input type="text" name="id" class="edits" size="11" maxlength="10"> <br/>				
				<label>Professor</label> <br>
				<?php
					include("../ClassesSQL/classeProfessorSQL.php");
					$persistir = new ProfessorSQL();
					$lista = $persistir->listarTodos();
					echo "<select name='professor' class='edits'>";
						for ($i = 0; $i < count($persistir->listarTodos()); $i++) {
							$id = $lista[$i]->getId();
							$nome = $lista[$i]->getNome();
							echo "<option value=$id> $nome </option>";
						} 
					echo "</select>";
				?> <br>
				<label>Curso</label> <br>
				<?php
					include("../ClassesSQL/classeCursoSQL.php");
					$persistir = new CursoSQL();
					$lista = $persistir->listarTodos();
					echo "<select name='curso' class='edits'>";
						for ($i = 0; $i < count($persistir->listarTodos()); $i++) {
							$id = $lista[$i]->getId();
							$descricao = $lista[$i]->getDescricao();
							echo "<option value=$id> $descricao </option>";
						} 
					echo "</select>";
				?> <br>
				<label> Dia da aula </label> <br>
				<p>
					<input type="checkbox" name="dia[]" value="1" class="edits"> Domingo
					<input type="checkbox" name="dia[]" value="2"> Segunda
					<input type="checkbox" name="dia[]" value="3"> Terça
					<input type="checkbox" name="dia[]" value="4"> Quarta
					<input type="checkbox" name="dia[]" value="5"> Quinta
					<input type="checkbox" name="dia[]" value="6"> Sexta
					<input type="checkbox" name="dia[]" value="7"> Sábado
				</p>
			</form>
		</div>
		
		<div id="rodape">
			<p>I CS - Cisilio's Sistemas &copy;2014 - Todos os direitos reservados I <a href="#"></a> </p>
		</div>	
		
	</div>
</body>