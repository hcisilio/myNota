<?php 
	session_start("mynota");
	if ($_SESSION["logado"] <> "true") {
		header("Location: login.php");
	}
	else if ( ($_SESSION["acesso"] == "Diretor") || ($_SESSION["acesso"] == "Administrador") ){
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
	<title>Controle da turma</title>
	<link rel="stylesheet" type="text/css" href="CSS/estilos.css">
	<link href="CSS/bootstrap.css" rel="stylesheet">	
	<script src="../Ajax/jQuery.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<script>
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

	function listaAulas(turma) {				
	    $.ajax({			        
			type: "POST",
			url: "constroiAulasTurma.php",
			data: { turma: turma },
			
			beforeSend: function() {						
				
			},
			success: function(txt) {		
				$( '#aulas' ).html(txt);						
			},
			error: function(txt) {				
				$( '#aulas' ).html('fudeu');
			}
	    });
	}

	function listaAlunos(turma) {		
	    $.ajax({	    
			type: "GET",
			url: "constroiNotasTurma.php",
			data: { turma: turma },
			
			beforeSend: function() {
				
			},
			success: function(txt) {
				$( '#notas' ).html(txt);						
			},
			error: function(txt) {
				$( '#notas' ).html('fudeu');
			}
	    });
	}

	function mudaAba(){
		$('#tab a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		})
	}
	</script>
</head>

<body onLoad="trocaPesquisa('todas')">

	<!-- NavBar -->
	<nav class="navbar navbar-default" role="navigation" id="barra">
		<div class="container-fluid">
			<div class="navbar-header">
				<!-- colocar alguma imagem mynota -->
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">	
					<li> <a href="JavaScript:matricularAluno()"> <img src="Imagens/save.png"> </a></li>				         
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
			<div class="input-group abaixo">													
				<span class="input-group-addon edits"><span class="glyphicon glyphicon-barcode"></span></span>			 		
				<select id="turma" name="turma" class="form-control edits" onChange="listaAulas(this.value);listaAlunos(this.value);">
					<option value='null'> Selecione uma turma </option>
				</select>																													
			</div>	
			<!-- Nav tabs -->	
			<ul id="tab" class="nav nav-tabs" role="tablist">			  	
			 	<li class="active"><a href="#aulas" onclick="mudaAba()">Aulas</a></li>
			  	<li><a href="#notas" onclick="mudaAba()">Notas</a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">				
				<div class="tab-pane active" id="aulas"> Selecione a turma </div>
				<div class="tab-pane" id="notas"> Selecione a turma </div>				
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