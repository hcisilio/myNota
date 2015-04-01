<?php 
	include_once ("../Controladores/controladorPermissao.php");
	$persistir = new ControladorPermissao();
	$persistir->autorizarAcesso( end(explode("/", $_SERVER['PHP_SELF'])) );
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Controle da turma</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link href="css/bootstrap.css" rel="stylesheet">	
	<script src="js/jQuery.js"></script>	
	<script src="js/validacoes.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<script>
	function detalharTurma(){
		var turma = $("#q").val();
		//listando as aulas
		$.ajax({			        
			type: "POST",
			url: "constroiAulasTurma.php",
			data: { turma: turma },
			success: function(txt) {		
				$( '#aulas' ).html(txt);						
			}
	    });
	    //listando alunos e notas
	    $.ajax({	    
			type: "GET",
			url: "constroiNotasTurma.php",
			data: { turma: turma },
			success: function(txt) {
				$( '#notas' ).html(txt);						
			}
	    });
	    //listando os planos de aula
	    $.ajax({	    
			type: "GET",
			url: "constroiPlanosAulaTurma.php",
			data: { turma: turma },
			success: function(txt) {
				$( '#planos' ).html(txt);						
			}
	    });
	    //listando os dados cadastrais
	    $.ajax({	    
			type: "GET",
			url: "editarTurma.php",
			data: { turma: turma },
			success: function(resultado) {
				$( '#dadosCadastrais' ).html(resultado);						
			}
	    });
	}
   function preparaEdicao(){
	   	$( '#id' ).attr('value', $("#q").val());
	   	//listando os professores
	   	$.ajax({			        
			type: "POST",
			url: "../Controladores/controlador.php",
			data: { 					
				tipo: "Ativo",					
				classe: "Professor",
				metodo: "criarCombo"					
			},				
			beforeSend: function(){
				$("#professor").empty();				
				$("#professor").append('<option>Carregando...</option>');
			},
			success: function(combo) {	
				$("#professor").empty();				
				$("#professor").append(combo);
			}
	    });
   }

   function editarTurma() {   		
	   	if ( nuloOUvazio("#edicaoTurma") ) {
		   var dias = new Array();		   
		   for (i=0; i<7; i++) {
			   if ($("#dias input")[i].checked) {
				   dias.push( $($("#dias input")[i]).val() );
			   }
			};	
	       	$.ajax({			        
				type: "POST",
				url: "../Controladores/controlador.php",
				data: { 
					id: $("#id").val(),
					professor: $("#professor").val(),
					dias: dias,									
					classe: "Turma",
					metodo: "alterar" 
				},
				success: function(resultado) {
					$('#msg').hide();				
					$('#msg').html(resultado);
					$('#msg').show("slow");	
				},
				error: function(resultado) {				
					
				}
		    });
	   	}
   }

	function imprimeNotas(){
		location.href="../Controladores/controlador.php?classe=Nota&metodo=imprimir&turma="+$("#q").val();
	}

	function imprimePlano(id){	
		location.href="../Controladores/controlador.php?classe=PlanoAula&metodo=imprimir&id="+id;
	}
	</script>
</head>

<body>

	<!-- NavBar -->
	<nav class="navbar navbar-default" role="navigation" id="barra">
		<div class="container-fluid">
			<div class="navbar-header">
				<ul class="nav navbar-nav navbar-left">	
					<li><a href="../GUIs/home.php"> <img alt="Brand" src="Imagens/sublogo_branco.png"> </a></li>
				</ul>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">	
					<li id="iconeImprimir" style="display:none"> <a href="JavaScript:imprimeNotas()"> <img src="Imagens/print.png"> </a></li>
					<li id="iconeSalvar" style="display:none"> <a href="JavaScript:editarTurma()"> <img src="Imagens/save.png"> </a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Conteúdo estático da páginas -->
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
			<div id="msg"> </div>
			<div class="input-group abaixo">
				<input type="text" id="q" name="q" class="form-control edits" placeholder="Digite o código da turma">
				<span class="input-group-addon edits">
					<a href="JavaScript:detalharTurma()" onclick="JavaScript:$('#iconeSalvar').show()" class="glyphicon glyphicon-search"></a>
				</span>																														
			</div>	
			<!-- Nav tabs -->
			<ul class="nav nav-tabs">
				<li class="active"><a href="#dadosCadastrais" onclick="$('#iconeImprimir').hide();$('#iconeSalvar').show()" data-toggle="tab">Dados Cadastrais</a></li>
				<li class=""><a href="#planos" onclick="$('#iconeImprimir').hide();$('#iconeSalvar').hide()" data-toggle="tab">Planos de Aula</a></li>
				<li class=""><a href="#aulas" onclick="$('#iconeImprimir').hide()" data-toggle="tab">Aulas Ministradas</a></li>
				<li class=""><a href="#notas" onclick="$('#iconeImprimir').show();$('#iconeSalvar').hide()" data-toggle="tab">Notas</a></li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">				
				<div class="tab-pane active" id="dadosCadastrais"> 
					
				</div>
				<div class="tab-pane" id="planos"> Selecione a turma </div>
				<div class="tab-pane" id="aulas"> Selecione a turma </div>
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