<?php
	session_start("mynota");
	if ($_SESSION["logado"] <> "true") {
		header("Location: login.php");
	}
	else {
		//acesso permitido	
		$acesso = $_SESSION["acesso"];
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Registrar Aula</title>
	<link rel="stylesheet" type="text/css" href="CSS/estilos.css">
	<link href="CSS/bootstrap.css" rel="stylesheet">	
	<script src="js/bootstrap.min.js"></script>	
	<script type="text/javascript" src="../Ajax/jQuery.js"></script>
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
				
				beforeSend: function() {						
					
				},
				success: function(txt) {						
					listaAulas($("#turma").val());
					$("#conteudo").val(null);				
				},
				error: function(txt) {				
					
				}
		    });
			
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
					
					beforeSend: function() {						
						
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
					
					beforeSend: function() {						
						
					},
					success: function(resultado) {						
						listaAulas($("#turma").val());			
					},
					error: function(resultado) {				
						
					}
			    });
			}
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
					<li> <a href="JavaScript:finalizarTurma()"> <img src="Imagens/ok.png"> </a></li>
					<li> <a href="JavaScript:insereAula()"> <img src="Imagens/save.png"> </a></li>  				         
				</ul>
			</div>
		</div>
	</nav>

	<div id="row">
		<!-- menu lateral -->
		<div class="col-md-3 menuLateral">
			<?php include("opcoes$acesso.php"); ?>
		</div>
		<!-- espaçamento -->
		<div class="col-md-1">
		</div>
		<!-- conteúdo -->
		<div id="principal" class="abaixo col-md-7">			
			<form id="aula" class="form-inline" role="form" action="../Controladores/controlador.php" method="post">		
				<div class="input-group abaixo">
					<span class="input-group-addon edits"><span class="glyphicon glyphicon-barcode"></span></span>			 		
					<select id="turma" name="turma" class="form-control edits" onChange="listaAulas(this.value);">
						<option value='null'> Selecione uma turma </option>
						<?php
							include_once("../Controladores/controladorTurma.php");
							$persistir = new ControladorTurma();
							$professor = $_SESSION["professor"];
							$lista = $persistir->listarMinhas($professor);
							for ($i = 0; $i < count($persistir->listarMinhas($professor)); $i++) {
								$id = $lista[$i]->getId();
								echo "<option value=$id> $id </option>";
							} 		
						?> 
					</select>																													
				</div>
				<div class="input-group abaixo">
			 		<span class="input-group-addon edits"><span class=" glyphicon glyphicon-calendar"></span></span>			 		
					<input readonly class="form-control edits" name="data" id="data" type="text" value="<?php echo date("d/m/Y") ?>" placeholder="dd/mm/YYYY">
			  	</div>
				<div class="input-group abaixo">
					<textarea rows="10" cols="200%" name="conteudo" id="conteudo" class="form-control edits"></textarea>
				</div>	
			</form>	
			
			<div id="tabela">
			</div>
			
		</div>	
		<!-- sobra -->
		<div class="col-md-1">
		</div>
		
	</div>
			
	<!-- rodapé -->
	<?php include ("rodape.php") ?>

</body>