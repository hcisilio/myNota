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
	<title>Matricular Aluno</title>
   	<link rel="stylesheet" type="text/css" href="CSS/estilos.css">
	<link href="CSS/bootstrap.css" rel="stylesheet">	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>	
	<script src="js/bootstrap.min.js"></script>
	<script>
		function doPost(formName) {
		    var theForm = document.getElementById(formName);
		    theForm.submit();
		}
		function buscarAluno() {		
			/* Ajax para consultar e listar os alunos */
			var q = $("#q").val();
			$.ajax({			        
				type: "POST",
				url: "../Controladores/controlador.php",
				data: { 
					q: q,
					classe: "Aluno",
					metodo: "buscar" 
				},
				
				beforeSend: function() {						
					
				},
				success: function(resultado) {
					$("#resultado").html(resultado);								
				},
				error: function(txt) {				
					
				}
		    });		
		}
		function pegueme(aluno, nome) {			
			//parent.document.getElementById("email").value = "teste";
			$( '#aluno' ).attr('value', aluno);
			$( '#nome' ).attr('value', nome);
			$( "#selecionarAluno").modal('toggle');
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
				<ul class="nav navbar-nav navbar-right">	
					<li> <a href="JavaScript:doPost('alunoTurma')"> <img src="Imagens/save.png"> </a></li>				         
				</ul>
			</div>
		</div>
	</nav>
	
	
	<!-- Modal -->
	<div class="modal fade" id="selecionarAluno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		 <div class="modal-content">
		   <div class="modal-header">
		     <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		     <h4 class="modal-title" id="myModalLabel">Selecionar Aluno</h4>
		   </div>
		   <div class="modal-body">
		     <form id='buscarAluno' action='../Controladores/controlador.php' method='get'>
				<div class="input-group abaixo">
			 		<span class="input-group-addon edits">Q</span>			 		
					<input type="text" id="q" class="form-control edits" size="41" placeholder="Digite o nome ou a matrícula do aluno">
					<span class="input-group-addon edits"><a href="JavaScript:buscarAluno()" class="glyphicon glyphicon-search"></a></span>									  	
			  	</div>
			  	<font class="obs"> Obs.: Deixe em branco para buscar todos os alunos </font>
			</form>
			<div id="resultado"></div>
		   </div>
		 </div>
	  </div>
	</div>		
	
	<div id="row">
		<!-- menu lateral -->
		<div class="col-md-3 menuLateral">
			<?php include("opcoes$acesso.php"); ?>
		</div>
		<!-- espaçamento -->
		<div class="col-md-1">
		</div>
		<!-- conteúdo -->
		<div class="col-md-7">			
			<form id="alunoTurma" action="../Controladores/controlador.php" method="post">
				<input type="hidden" name="classe" value="AlunoTurma">
				<input type="hidden" name="metodo" value="inserir">
				<input type="hidden" id="aluno" name="aluno" id="aluno">			
				<div class="input-group abaixo" data-toggle="modal" data-target="#selecionarAluno">
			 		<span class="input-group-addon edits"><span class="glyphicon glyphicon-barcode"></span></span>			 		
					<input type="text" name="nome" id="nome" class="form-control edits" size="30" placeholder="Clique para selecionar o aluno" readonly/>				
			  		<span class="input-group-addon edits"><span class="glyphicon glyphicon-search"></span></span>
			  	</div>				
				<div class="input-group abaixo">
			  		<span class="input-group-addon edits"><span class="glyphicon glyphicon-barcode"></span></span>	
			  		<?php
						include("../Controladores/controladorTurma.php");
						$persistir = new ControladorTurma();
						$lista = $persistir->listarAtivas();
						echo "<select name='turma' class='form-control edits'>";
							for ($i = 0; $i < count($persistir->listarAtivas()); $i++) {
								$id = $lista[$i]->getId();
								echo "<option value=$id> $id </option>";
							} 
						echo "</select>";
					?>
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