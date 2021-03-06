<?php
	include_once ("../Controladores/controladorPermissao.php");
	$persistir = new ControladorPermissao();
	$persistir->autorizarAcesso( end(explode("/", $_SERVER['PHP_SELF'])) );	
?>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	<title>Lançar notas</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link href="css/bootstrap.css" rel="stylesheet">	
	<script src="js/bootstrap.min.js"></script>	
	<script type="text/javascript" src="js/jQuery.js"></script>
	<script type="text/javascript">
	function listaAlunos(turma) {		
	    $.ajax({	    
			type: "GET",
			url: "constroiNotasTurma.php",
			data: { turma: turma },
			
			beforeSend: function() {
				$("#tabela").html("<img src='Imagens/carregando.gif'/>");
			},
			success: function(txt) {
				$( '#tabela' ).html(txt);						
			},
			error: function(txt) {
				$( '#tabela' ).html('fudeu');
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
	function imprimeNotas(){
		location.href="../Controladores/controlador.php?classe=Nota&metodo=imprimir&turma="+$("#turma").val();
	}
	</script>
</head>

<body OnLoad="listarTurmas('minhas')">

	<!-- NavBar -->
	<nav class="navbar navbar-default" role="navigation" id="barra">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="../GUIs/home.php"> <img alt="Brand" src="Imagens/sublogo_branco.png"> </a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">	
					<li> <a href="JavaScript:imprimeNotas()"> <img src="Imagens/print.png"> </li>				         
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
				<span class="input-group-addon edits"><span class="glyphicon glyphicon-barcode"></span></span>			 		
				<select name="turma" class="form-control edits" id="turma" onChange="listaAlunos(this.value);"> </select>
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
</html>
