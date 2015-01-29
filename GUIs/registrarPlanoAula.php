<?php
	include_once ("../Controladores/controladorPermissao.php");
	$persistir = new ControladorPermissao();
	$persistir->autorizarAcesso( end(explode("/", $_SERVER['PHP_SELF'])) );
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Registrar Plano de Aula</title>
	<link rel="stylesheet" type="text/css" href="CSS/estilos.css">
	<link href="CSS/bootstrap.css" rel="stylesheet">	
	<script src="../Ajax/jQuery.js"></script>
	<script type="text/javascript" src="../Ajax/validacoes.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<script type="text/javascript">
		function listaPlanos(turma) {				
		    $.ajax({			        
				type: "POST",
				url: "constroiPlanosAulaTurma.php",
				data: { turma: turma },
				
				beforeSend: function() {						
					$( '#tabela' ).html("<img src='Imagens/carregando.gif'/>");
				},
				success: function(txt) {		
					$( '#tabela' ).html(txt);						
				},
				error: function(txt) {				
					$( '#tabela' ).html('fudeu');
				}
		    });
		}
	
		function inserePlano() {
			if ( nuloOUvazio("#planoAula") ) {
				/* Ajax para inserir plano de aulas no banco de dados */
				$.ajax({			        
					type: "POST",
					url: "../Controladores/controlador.php",
					data: { 
						turma: $("#turma").val(),
						modulo: $("#modulo").val(),
						caps: $("#caps").val(),
						conteudo: $("#conteudo").val(),
						recursos: $("#recursos").val(),
						desenvolvimento: $("#desenvolvimento").val(),
						avaliacoes: $("#avaliacoes").val(),
						data: $("#data").val(),
						classe: "PlanoAula",
						metodo: "inserir" 
					},
					beforeSend: function(){
						$( "#novoPlanoAula").modal('toggle');
					},
					success: function(txt) {						
						removeFalhaValidacao("#aula");		
						listaPlanos($("#turma").val());
						$("#caps").val(null);
						$("#conteudo").val(null);
						$("#recursos").val(null);
						$("#desenvolvimento").val(null);
						$("#avaliacoes").val(null);
					},
					error: function(txt) {				
						$("#tabela").html('fudeu');
					}
			    });
			}
		}

		function removePlano(aula){			
			resposta = confirm("Tem certeza que deseja excluir este plano aula?");
			if (resposta) {
				$.ajax({			        
					type: "POST",
					url: "../Controladores/controlador.php",
					data: { 
						id: aula,										
						classe: "PlanoAula",
						metodo: "deletar" 
					},
					success: function(resultado) {						
						listaPlanos($("#turma").val());			
					},
					error: function(resultado) {				
						
					}
			    });
			}
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
		
		function listarModulos(turma){
			$.ajax({
				type: "POST",
				url: "../Controladores/controlador.php",
				data: {
					classe: "Modulo",
					metodo: "criarCombo",
					consulta: "listarPorTurma",
					turma: turma			
				},
				beforeSend: function(){
					$("#modulo").empty();				
					$("#modulo").append('<option>Carregando...</option>');
				},
				success: function(combo) {	
					$("#modulo").empty();				
					$("#modulo").append(combo);						
				},
				error: function(combo) {
					$("#modulo").empty();				
					$("#modulo").append("<option>fudeu</option>");
				}
			});
		}

		function imprimePlano(id){
			location.href="../Controladores/controlador.php?classe=PlanoAula&metodo=imprimir&id="+id;
		}
	</script>
</head>

<body onLoad="listarTurmas('minhas')">

	<!-- NavBar -->
	<nav class="navbar navbar-default" role="navigation" id="barra">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="../GUIs/home.php"> <img alt="Brand" src="Imagens/sublogo_branco.png"> </a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li> <a href="" data-toggle="modal" data-target="#novoPlanoAula"> <img src="Imagens/new-page.png"> </a></li>  
				</ul>
			</div>
		</div>
	</nav>
	<!-- Modal -->
	<div id="novoPlanoAula" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		   	<div class="modal-header">
		     	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		     	<h4 class="modal-title" id="myModalLabel">Registrar novo plano de aula</h4>
		   	</div>
		   	<div class="modal-body">
			   <form id="planoAula" class="form-inline" role="form" action="../Controladores/controlador.php" method="post">
			   		<div class="input-group abaixo">													
						<span class="input-group-addon edits"><span class="glyphicon glyphicon-barcode"></span></span>			 		
						<select id="modulo" name="modulo" class="form-control edits nuloOUvazio">
							<option value='null'> Selecione primeiro uma turma! </option>
						</select>					
					</div>
					<div class="input-group abaixo">				
						<span class="input-group-addon edits"><span class=" glyphicon glyphicon-calendar"></span></span>			 		
						<input class="form-control edits nuloOUvazio" name="data" id="data" type="date" placeholder="dd/mm/YYYY">																												
					</div>
					<div class="input-group abaixo">
						<textarea rows="1" cols="100%" name="caps" id="caps" placeholder="Capítulos da apostila" class="form-control edits nuloOUvazio"></textarea>
					</div>
					<div class="input-group abaixo">
						<textarea rows="1" cols="100%" name="recursos" id="recursos" placeholder="Recursos ditáticos" class="form-control edits nuloOUvazio"></textarea>
					</div>
					<div class="input-group abaixo">
						<textarea rows="5" cols="100%" name="conteudo" id="conteudo" placeholder="Conteúdo" class="form-control edits nuloOUvazio"></textarea>
					</div>
					<div class="input-group abaixo">
						<textarea rows="5" cols="100%" name="desenvolvimento" id="desenvolvimento" placeholder="Desenvolvimento do tema" class="form-control edits nuloOUvazio"></textarea>
					</div>				
					<div class="input-group abaixo">
						<textarea rows="5" cols="100%" name="avaliacoes" id="avaliacoes" placeholder="Avaliações" class="form-control edits nuloOUvazio"></textarea>
					</div>
					<div align="right">
						<input type="button" class="btn btn-primary" id="btnSubmit" value="Salvar" onclick="JavaScript:inserePlano()">						
					</div>
				</form>
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
			<div class="input-group abaixo">													
				<span class="input-group-addon edits"><span class="glyphicon glyphicon-barcode"></span></span>			 		
				<select id="turma" name="turma" class="form-control edits nuloOUvazio" onChange='listarModulos(this.value); listaPlanos(this.value)'>
					<option value='null'> Selecione uma turma </option>
				</select>																													
			</div>			
			<div id="tabela" class="abaixo">
			</div>
		</div>	
		<!-- sobra -->
		<div class="col-md-1">
		</div>
		
	</div>
			
	<!-- rodapé -->
	<?php include ("rodape.php") ?>

</body>