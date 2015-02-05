<?php 
	include_once ("../Controladores/controladorPermissao.php");
	$persistir = new ControladorPermissao();
	$persistir->autorizarAcesso( end(explode("/", $_SERVER['PHP_SELF'])) );
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Controle da Professores</title>
	<link rel="stylesheet" type="text/css" href="CSS/estilos.css">
	<link href="CSS/bootstrap.css" rel="stylesheet">	
	<script src="../Ajax/jQuery.js"></script>
	<script src="../Ajax/tabs.js"></script>
	<script type="text/javascript" src="../Ajax/validacoes.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<script>
	function listarProfessores(tipo){
		$.ajax({
			type: "POST",
			url: "../Controladores/controlador.php",
			data: {
				classe: "Professor",
				metodo: "criarTabela",
				tipo: tipo
			},
			beforeSend: function(){
				$("#"+tipo).empty();				
				$("#"+tipo).append('<option>Carregando...</option>');
			},
			success: function(tabela){			
				$("#"+tipo).empty();				
				$("#"+tipo).append(tabela);						
			}
		});
	}
	function alterarStatus(valor){
		$(function () {
			$("td").click(function () {
				resposta = confirm("Tem certeza que deseja prosseguir?");
				if (resposta) {
					$.ajax({
						type: "POST",
						url: "../Controladores/controlador.php",
						data: {
							classe: "Professor",
							metodo: "alterar",
							ativo: valor,
							id: $(this).parents('tr').children().first().text()
						},
						beforeSend: function(){							
							
						},
						success: function(resultado) {
							$("#msg").hide();
							$("#msg").html(resultado);
							$("#msg").show('slow');
							if (valor == 'Ativo') {
								listarProfessores('Inativo');
							} 
							else if (valor == 'Inativo') {
								listarProfessores('Ativo');
							}
						}
					});
				}
			});
		});
	}

	function restaurarSenha(valor){
		$(function () {
			$("td").click(function () {
				resposta = confirm("Tem certeza que deseja prosseguir?");
				if (resposta) {
					$.ajax({
						type: "POST",
						url: "../Controladores/controlador.php",
						data: {
							classe: "Professor",
							metodo: "alterar",
							senha: valor,
							id: $(this).parents('tr').children().first().text()
						},
						beforeSend: function(){
							
						},
						success: function(resultado) {
							$("#msg").hide();
							$("#msg").html(resultado);
							$("#msg").show('slow');
						}
					});
				}
			});
		});
	}

	function preparaEdicao(){
		$(function () {
			$("td").click(function () {
				$.ajax({
					type: "POST",
					url: "../Controladores/controlador.php",
					data: {
						classe: "Professor",
						metodo: "preparaEdicao",						
						id: $(this).parents('tr').children().first().text()
					},
					beforeSend: function(){
						
					},
					success: function(resultado) {
						$("#formularioEdicao").html(resultado);
					}
				});
			});
		});
	}

	function editarProfessor(){
		if ( nuloOUvazio("#editarProfessor") ) {
			$.ajax({
				type: "POST",
				url: "../Controladores/controlador.php",
				data: {
					classe: "Professor",
					metodo: "alterar",
					id: $("#editarProfessor #id").val(),
					nome: $("#editarProfessor #nome").val(),				
					acesso: $("#editarProfessor #acesso").val(),
					comentario: $("#editarProfessor #comentario").val()
				},
				beforeSend: function(){
					
				},
				success: function(resultado) {
					$("#editarProfessorModal").modal('toggle');
					$("#msg").hide();
					$("#msg").html(resultado);
					$("#msg").show('slow');
					listarProfessores('Ativo');
				}
			});
		}
	}
	function registrarProfessor() {
	   if ( nuloOUvazio("#novoProfessor") ) {
	       $.ajax({			        
				type: "POST",
				url: "../Controladores/controlador.php",
				data: { 
					id: $("#novoProfessor #id").val(),
					nome: $("#novoProfessor #nome").val(),
					senha: $("#novoProfessor #senha").val(),
					acesso: $("#novoProfessor #acesso").val(),
					comentario: $("#novoProfessor #comentario").val(),				
					classe: "Professor",
					metodo: "inserir" 
				},
				success: function(resultado) {
					$("#novoProfessorModal").modal('toggle');
					$('#msg').hide();				
					$('#msg').html(resultado);
					$('#msg').show("slow");	
					listarProfessores('Ativo');
				}
		    });
	   }
   }
	</script>
</head>

<body onLoad="listarProfessores('Ativo')">

	<!-- NavBar -->
	<nav class="navbar navbar-default" role="navigation" id="barra">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="../GUIs/home.php"> <img alt="Brand" src="Imagens/sublogo_branco.png"> </a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">	
					<li> <a href="" data-toggle="modal" data-target="#novoProfessorModal"> <img src="Imagens/new-page.png"> </a> </li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Modal de edição de um professor -->
	<div id="editarProfessorModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		   	<div class="modal-header">
		     	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		     	<h4 class="modal-title" id="myModalLabel">Editar Professor</h4>
		   	</div>
		   	<div id="formularioEdicao" class="modal-body"> </div>
		</div>
	  </div>
	</div>
	<!-- Modal de Registro de um novo professor -->
	<div id="novoProfessorModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		   	<div class="modal-header">
		     	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		     	<h4 class="modal-title" id="myModalLabel">Registrar Novo Professor</h4>
		   	</div>
		   	<div id="formularioCriacao" class="modal-body">
				<form id="novoProfessor" action="../Controladores/controlador.php" method="post">
					<div class="input-group abaixo">
				 		<span class="input-group-addon edits"><span class="glyphicon glyphicon-user"></span></span>			 		
						<input class="form-control edits nuloOUvazio" name="id" id="id" type="text" placeholder="Login" maxlength="20">
				  	</div>
					<div class="input-group abaixo">
				 		<span class="input-group-addon edits"><span class="glyphicon glyphicon-pencil"></span></span>			 		
						<input class="form-control edits nuloOUvazio" name="nome" id="nome" type="text" placeholder="Nome Completo">
				  	</div>
				  	<div class="input-group abaixo">
				 		<span class="input-group-addon edits"><span class="glyphicon"><img src="Imagens/glyphicons_044_keys.png" style="width: 14px; height: 14px;"></span></span>			 		
						<input class="form-control edits nuloOUvazio" name="senha" id="senha" type="password" placeholder="Senha">
				  	</div>
				  	<div class="input-group abaixo">
				  		<span class="input-group-addon edits"><span class="glyphicon glyphicon-tags"></span></span>		
						<select id="acesso" name="acesso" class="form-control edits">
							<option value="Professor"> Professor </option>
							<option value="Diretor"> Diretor </option>
							<option value="Administrador"> Administrador </option>
						</select>
					</div>
					<div class="input-group abaixo">
						<textarea name="comentario" id="comentario" cols="200%" rows="5" class="form-control edits" placeholder="Comentários"></textarea>
					</div>
					<div align='right'>
						<input type='button' class='btn btn-primary' value='Salvar' onclick='JavaScript:registrarProfessor()'>						
					</div>
				</form>
		   	</div>
		</div>
	  </div>
	</div>
	<!-- conteúdo -->	
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
			<!-- Nav tabs -->	
			<ul id="tab" class="nav nav-tabs" role="tablist">			  	
			 	<li class="active"><a href="#Ativo" onclick="mudaAba(); listarProfessores('Ativo')">Ativos</a></li>
			  	<li><a href="#Inativo" onclick="mudaAba(); listarProfessores('Inativo')">Inativos</a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">				
				<div class="tab-pane active" id="Ativo">  </div>
				<div class="tab-pane" id="Inativo">  </div>								
			</div>	
		</div>
		<!-- sobra -->
		<div class="col-md-1">
		</div>
	</div>
	
	<!-- rodapé -->
	<?php include ("rodape.php") ?>

</body>

</html>