<?php
	include_once ("../Controladores/controladorPermissao.php");
	$persistir = new ControladorPermissao();
	$persistir->autorizarAcesso( end(explode("/", $_SERVER['PHP_SELF'])) );	
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Registrar Aula</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link href="css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="css/jquery-ui.min.css">
	<script type="text/javascript" src="js/jQuery.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/datepicker.js"></script>
	<script type="text/javascript" src="js/validacoes.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		function listaAulas(turma) {				
		    $.ajax({			        
				type: "POST",
				url: "constroiAulasTurma.php",
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
	
		function insereAula() {
			if ( nuloOUvazio("#aula") ) {
				/* Ajax para inserir a aula dada no banco de dados */
				$.ajax({			        
					type: "POST",
					url: "../Controladores/controlador.php",
					data: { 
						turma: $("#turma").val(),
						conteudo: $("#conteudo").val(),
						data: $("#data").val(),
						classe: "Aula",
						metodo: "inserir" 
					},
					success: function(txt) {
						removeFalhaValidacao("#aula");		
						listaAulas($("#turma").val());
						$("#conteudo").val(null);				
					},
					error: function(txt) {				
						
					}
			    });
			}
		}
	
		function finalizarTurma() {
			resposta = confirm("Tem certeza que deseja concluir o curso desta turma?");
			if (resposta) {
				$.ajax({			        
					type: "POST",
					url: "../Controladores/controlador.php",
					data: { 
						turma: $("#turma").val(),										
						classe: "Turma",
						metodo: "encerrar" 
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

		function removeAula(aula){			
			resposta = confirm("Tem certeza que deseja excluir esta aula?");
			if (resposta) {
				$.ajax({			        
					type: "POST",
					url: "../Controladores/controlador.php",
					data: { 
						id: aula,										
						classe: "Aula",
						metodo: "deletar" 
					},
					success: function(resultado) {						
						listaAulas($("#turma").val());			
					},
					error: function(resultado) {				
						
					}
			    });
			}
		}

		function trocaPesquisa(tipo){
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
	</script>
</head>

<body onLoad="trocaPesquisa('minhas')">

	<!-- NavBar -->
	<nav class="navbar navbar-default" role="navigation" id="barra">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="../GUIs/home.php"> <img alt="Brand" src="Imagens/sublogo_branco.png"> </a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">	
					<li> <a href="JavaScript:finalizarTurma()"> <img src="Imagens/ok.png"> </a></li>
					<li> <a href="JavaScript:insereAula()"> <img src="Imagens/save.png"> </a></li>  				         
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
		<div class="col-md-1">
		</div>
		<!-- conteúdo -->
		<div id="principal" class="abaixo col-md-7">
			<div class="input-group abaixo">
			  	<label class="radio-inline">
				  	<input type="radio" name="pesquisa" id="minhas" value="minhas" checked onClick="trocaPesquisa(this.value)"> Minhas turmas
				</label>
				<label class="radio-inline">
				  	<input type="radio" name="pesquisa" id="todas" value="ativas" onClick="trocaPesquisa(this.value)"> Todas as turmas
				</label>
			</div>		
			<form id="aula" class="form-inline" role="form" action="../Controladores/controlador.php" method="post">						
				<div class="input-group abaixo">													
					<span class="input-group-addon edits"><span class="glyphicon glyphicon-barcode"></span></span>			 		
					<select id="turma" name="turma" class="form-control edits nuloOUvazio" onChange="listaAulas(this.value);">
						<option value='null'> Selecione uma turma </option>
					</select>																													
				</div>
				<div class="input-group abaixo">
			 		<span class="input-group-addon edits"><span class=" glyphicon glyphicon-calendar"></span></span>			 		
					<input class="form-control edits nuloOUvazio br-data-widget datepicker" name="data" id="data" type="text" value="<?php echo date("d/m/Y") ?>" placeholder="dd/mm/YYYY">
			  	</div>
				<div class="input-group abaixo">
					<textarea rows="10" cols="200%" name="conteudo" id="conteudo" class="form-control edits nuloOUvazio" placeholder="Conteúdo ministrado"></textarea>
				</div>	
			</form>	
			
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