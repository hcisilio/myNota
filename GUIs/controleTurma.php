<?php 
	include_once ("../Controladores/controladorPermissao.php");
	$persistir = new ControladorPermissao();
	$persistir->autorizarAcesso( end(explode("/", $_SERVER['PHP_SELF'])) );
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Controle da turma</title>
	<link rel="stylesheet" type="text/css" href="CSS/estilos.css">
	<link href="CSS/bootstrap.css" rel="stylesheet">	
	<script src="../Ajax/jQuery.js"></script>
	<script src="../Ajax/tabs.js"></script>
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
			success: function(txt) {
				$( '#notas' ).html(txt);						
			},
			error: function(txt) {
				$( '#notas' ).html('fudeu');
			}
	    });
	}

	function listaPlanosAula(turma) {		
	    $.ajax({	    
			type: "GET",
			url: "constroiPlanosAulaTurma.php",
			data: { turma: turma },
			success: function(txt) {
				$( '#planos' ).html(txt);						
			},
			error: function(txt) {
				$( '#planos' ).html('fudeu');
			}
	    });
	}

	function imprimeNotas(){			
		location.href="../Controladores/controlador.php?classe=Nota&metodo=imprimir&turma="+$("#turma").val();
	}

	function imprimePlano(id){			
		location.href="../Controladores/controlador.php?classe=PlanoAula&metodo=imprimir&id="+id;
	}
	</script>
</head>

<body onLoad="trocaPesquisa('todas')">

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
				<!-- <span class="input-group-addon edits"><span class="glyphicon glyphicon-barcode"></span></span>			 		
				<select id="turma" name="turma" class="form-control edits" onChange="listaAulas(this.value);listaAlunos(this.value);">
					<option value='null'> Selecione uma turma </option>
				</select> -->
				<input type="text" id="turma" name="turma" class="form-control edits" placeholder="Digite o código da turma">
				<span class="input-group-addon edits">
					<a href="JavaScript:listaPlanosAula($('#turma').val());listaAulas($('#turma').val());listaAlunos($('#turma').val());" class="glyphicon glyphicon-search"></a>
				</span>																														
			</div>	
			<!-- Nav tabs -->	
			<ul id="tab" class="nav nav-tabs" role="tablist">			  	
			 	<li class="active"><a href="#aulas" onclick="mudaAba()">Aulas</a></li>
			  	<li><a href="#notas" onclick="mudaAba()">Notas</a></li>
			  	<li><a href="#planos" onclick="mudaAba()">Planos de Aula</a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">				
				<div class="tab-pane active" id="aulas"> Selecione a turma </div>
				<div class="tab-pane" id="notas"> Selecione a turma </div>				
				<div class="tab-pane" id="planos"> Selecione a turma </div>
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