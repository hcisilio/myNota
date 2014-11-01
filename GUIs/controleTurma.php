<?php 
	include ("../permissao.php");
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
					<li> </li>				         
				</ul>
			</div>
		</div>
	</nav>
	
	<div id="row">
		<!-- menu lateral -->
		<div class="col-md-3 menuLateral">
			<?php include("opcoes".$_SESSION["acesso"].".php"); ?>
		</div>
		<!-- espaçamento -->
		<div class="col-md-1">
		</div>
		<!-- conteúdo -->
		<div id="principal" class="abaixo col-md-7">	
			<div class="input-group abaixo">													
				<!-- <span class="input-group-addon edits"><span class="glyphicon glyphicon-barcode"></span></span>			 		
				<select id="turma" name="turma" class="form-control edits" onChange="listaAulas(this.value);listaAlunos(this.value);">
					<option value='null'> Selecione uma turma </option>
				</select> -->
				<input type="text" id="turma" name="turma" class="form-control edits" placeholder="Digite o código da turma">
				<span class="input-group-addon edits"><a href="JavaScript:listaAulas($('#turma').val());listaAlunos($('#turma').val());" class="glyphicon glyphicon-search"></a></span>																														
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