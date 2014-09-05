<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Matricular Aluno</title>
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
				<li> <a href="JavaScript:doPost('aluno_turma')"> <img src="Imagens/save.png"> </a></li>            
			</ul>
		</div>
		
		<div id="menu">
			<?php include("mainMenu.php"); ?>
		</div>

		<div id="formulario">
			<form id="aluno_turma" action="../Controladores/controlador.php" method="post">
				<input type="hidden" name="classe" value="AlunoTurma">
				<input type="hidden" name="metodo" value="inserir">
				<input type="hidden" name="aluno" id="aluno">
				<label>Aluno </label><BR />
				<input type="text" name="nome" id="nome" class="edits" size="30" onclick="window.open('selecionarAluno.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=600, HEIGHT=400');"  readonly/>
				<img src="Imagens/lupa.png" onClick="window.open('selecionarAluno.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=600, HEIGHT=400');"><BR />			
				<label>Turma</label> <br>
				<?php
					include("../Controladores/controladorTurma.php");
					$persistir = new ControladorTurma();
					$lista = $persistir->listarAtivas();
					echo "<select name='turma' class='edits'>";
						for ($i = 0; $i < count($persistir->listarAtivas()); $i++) {
							$id = $lista[$i]->getId();
							echo "<option value=$id> $id </option>";
						} 
					echo "</select>";
				?> <br>				
			</form>
		</div>
		<div class="clear"> </div>
		
		<div id="rodape">
			<p>I CS - Cisilio's Sistemas &copy;2014 - Todos os direitos reservados I <a href="#"></a> </p>
		</div>	
		
	</div>
	
</body>