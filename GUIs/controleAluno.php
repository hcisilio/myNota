<?php 
	include_once ("../Controladores/controladorPermissao.php");
	$persistir = new ControladorPermissao();
	$persistir->autorizarAcesso( end(explode("/", $_SERVER['PHP_SELF'])) );
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Controle de Aluno</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link href="css/bootstrap.css" rel="stylesheet">	
	<script src="js/jQuery.js"></script>
	<script type="text/javascript" src="js/validacoes.js"></script>
	<script src="js/tabs.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<script>
		function alterarAluno() {
			if ( nuloOUvazio("#aluno") ) {
				$.ajax({			        
					type: "POST",
					url: "../Controladores/controlador.php",
					data: { 
						id: $("#id").val(),
						nome: $("#nome").val(),
						mail: $("#mail").val(),
						classe: "Aluno",
						metodo: "alterar"
					},
					success: function(resultado) {
						$('#msg').hide();				
						$('#msg').html(resultado);
						$('#msg').show("slow");	
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
				success: function(resultado) {
					$("#resultado").html(resultado);
				}
		    });		
		}
		function pegueme(aluno, nome, mail) {
			$( '#id' ).attr('value', aluno);
			$( '#nome' ).attr('value', nome);
			$( '#mail' ).attr('value', mail);
			$( '#msg' ).hide();
			consultarNotas();
			$( '#selecionarAluno').modal('toggle');
		}
		function consultarNotas() {
			$.ajax({			        
				type: "POST",
				url: "constroiNotasAluno.php",
				data: { 
					aluno: $("#id").val(),										
				},
				beforeSend: function() {
					$("#turmasNotas").html("<img src='Imagens/carregando.gif'/>");				
				},
				success: function(txt) {			
					$("#turmasNotas").html(txt);	
				}
			});
			
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
					<li> <a href="JavaScript:alterarAluno()"> <img src="Imagens/save.png"> </a></li>				         
				</ul>
			</div>
		</div>
	</nav>

	<!-- Modal buscar aluno-->
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
			<div id="msg" style="display:none"> </div>
			<form id="aluno" action="../Controladores/controlador.php" method="post">
				<div class="input-group abaixo" data-toggle="modal" data-target="#selecionarAluno">
			 		<span class="input-group-addon edits"><span class="glyphicon glyphicon-barcode"></span></span>	
					<input type="text" name="id" id="id" class="form-control edits nuloOUvazio" size="30" placeholder="Clique para selecionar o aluno" readonly/>				
			  		<span class="input-group-addon edits"><span class="glyphicon glyphicon-search"></span></span>
			  	</div>

			  	<!-- Nav tabs -->	
				<ul id="tab" class="nav nav-tabs" role="tablist">			  	
				 	<li class="active"><a href="#dadosCadastrais" onclick="mudaAba()">Dados Cadastrais</a></li>
				  	<li><a href="#turmasNotas" onclick="mudaAba()">Turmas e Notas</a></li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content">				
					<div class="tab-pane active" id="dadosCadastrais">
						<div class="input-group abaixo">
					 		<span class="input-group-addon edits"><span class="glyphicon glyphicon-pencil"></span></span>			 		
							<input class="form-control edits nuloOUvazio" name="nome" id="nome" type="text" placeholder="Nome Completo">
					  	</div>
					  	<div class="input-group abaixo">
					 		<span class="input-group-addon edits">@</span>			 		
							<input class="form-control edits" name="mail" id="mail" type="text" placeholder="E-mail">
					  	</div>
					</div>
					<div class="tab-pane" id="turmasNotas">
						<div class='alert alert-danger'> Utilize o campo acima para buscar o aluno </div>
					</div>							
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