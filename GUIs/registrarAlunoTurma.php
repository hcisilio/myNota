<?php 
	include_once ("../Controladores/controladorPermissao.php");
	$persistir = new ControladorPermissao();
	$persistir->autorizarAcesso( end(explode("/", $_SERVER['PHP_SELF'])) );
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Matricular Aluno</title>
   	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link href="css/bootstrap.css" rel="stylesheet">	
	<script src="js/jQuery.js"></script>
	<script type="text/javascript" src="js/validacoes.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
		function doPost() {
			if ( nuloOUvazio("#alunoTurma") ) {			
				$.ajax({		
					type: "POST",
					url: "../Controladores/controlador.php",
					data: { 
						aluno: $("#aluno").val(),
						turma: $("#turma").val(),
						classe: "AlunoTurma",
						metodo: "inserir" 
					},
					success: function(resultado) {
						$('#principal').hide();				
						$('#principal').html(resultado);
						$('#principal').show("slow");								
					},
					error: function(txt) {				
						
					}
			    });
			}
		}
		function buscarAluno() {		
			/* Ajax para consultar e listar os alunos */
			$.ajax({			        
				type: "POST",
				url: "../Controladores/controlador.php",
				data: { 
					q: $("#q").val(),
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
		function listarTurmas(tipo){
			$.ajax({
				type: "POST",
				url: "../Controladores/controlador.php",
				data: {
					classe: "Turma",
					metodo: "criarCombo",
					tipo: tipo
				},
				beforeSend: function(){
					$("#turma").empty();				
					$("#turma").append('<option>Carregando...</option>');
				},
				success: function(combo) {	
					$("#turma").empty();				
					$("#turma").append(combo);						
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

<body OnLoad="listarTurmas('ativas')">

	<!-- NavBar -->
	<nav class="navbar navbar-default" role="navigation" id="barra">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="../GUIs/home.php"> <img alt="Brand" src="Imagens/sublogo_branco.png"> </a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">	
					<li> <a href="JavaScript:doPost()"> <img src="Imagens/save.png"> </a></li>				         
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
					<input type="text" id="q" class="form-control edits" size="41" onKeyUp="JavaScript:buscarAluno()" placeholder="Digite o nome ou a matrícula do aluno">
					<span class="input-group-addon edits"><a href="JavaScript:buscarAluno()" class="glyphicon glyphicon-search"></a></span>									  	
			  	</div>
			  	<p class="obs"> Obs.: Deixe em branco para buscar todos os alunos </p>
			</form>
			<div id="resultado"></div>
		   </div>
		 </div>
	  </div>
	</div>		
	
	<div id="row">
		<!-- menu lateral -->
		<div class="col-md-3 menuLateral">
			<?php $persistir->criarMenu() ?>
		</div>
		<!-- espaçamento -->
		<div class="col-md-1">
		</div>
		<!-- conteúdo -->
		<div id="principal" class="abaixo col-md-7">			
			<form id="alunoTurma" action="../Controladores/controlador.php" method="post">
				<input type="hidden" id="aluno" name="aluno">			
				<div class="input-group abaixo" data-toggle="modal" data-target="#selecionarAluno">
			 		<span class="input-group-addon edits"><span class="glyphicon glyphicon-user"></span></span>			 		
					<input type="text" name="nome" id="nome" class="form-control edits nuloOUvazio" size="30" placeholder="Clique para selecionar o aluno" readonly/>				
			  		<span class="input-group-addon edits"><span class="glyphicon glyphicon-search"></span></span>
			  	</div>				
				<div class="input-group abaixo">
			  		<span class="input-group-addon edits"><span class="glyphicon glyphicon-barcode"></span></span>	
			  		<select id='turma' name='turma' class='form-control edits nuloOUvazio'> </select>
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