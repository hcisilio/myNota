<?php 
	include_once ("../Controladores/controladorPermissao.php");
	$persistir = new ControladorPermissao();
	$persistir->autorizarAcesso( end(explode("/", $_SERVER['PHP_SELF'])) );
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Cadastrar Turma</title>
	<link rel="stylesheet" type="text/css" href="CSS/estilos.css">
	<link href="CSS/bootstrap.css" rel="stylesheet">	
	<script src="../Ajax/jQuery.js"></script>
	<script type="text/javascript" src="../Ajax/validacoes.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<script>
	   function doPost() {
		   if ( nuloOUvazio("#turma") ) {
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
						curso: $("#curso").val(),
						dias: dias,									
						classe: "Turma",
						metodo: "inserir" 
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

	   function listarProfessores(){
		   $.ajax({			        
				type: "POST",
				url: "../Controladores/controlador.php",
				data: { 					
					tipo: "ativos",					
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
				},
				error: function() {				
					
				}
		    });
	   }
	   
	   function listarCursos(){
		   $.ajax({			        
				type: "POST",
				url: "../Controladores/controlador.php",
				data: { 														
					classe: "Curso",
					metodo: "criarCombo",
					tipo: "todos"
				},				
				beforeSend: function(){
					$("#curso").empty();				
					$("#curso").append('<option>Carregando...</option>');
				},
				success: function(combo) {	
					$("#curso").empty();				
					$("#curso").append(combo);
				},
				error: function() {				
					
				}
		    });
	   }
	</script>
</head>

<body OnLoad="listarProfessores(), listarCursos()">


	<!-- NavBar -->
	<nav class="navbar navbar-default" role="navigation" id="barra">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="../GUIs/home.php"> <img alt="Brand" src="Imagens/sublogo_branco.png"> </a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">	
					<li> <a href="JavaScript:doPost()"> <img src="Imagens/save.png"> </a></li>				         
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
			<form id="turma" action="../Controladores/controlador.php" method="post">
				<div class="input-group abaixo">
			 		<span class="input-group-addon edits"><span class="glyphicon glyphicon-barcode"></span></span>			 		
					<input class="form-control edits nuloOUvazio" name="id" id="id" type="text" placeholder="ID da turma" maxlength="10">
			  	</div>
			  	<div class="input-group abaixo">
			  		<span class="input-group-addon edits"><span class="glyphicon glyphicon-user"></span></span>	
					<select id='professor' name='professor' class='form-control edits nuloOUvazio'> </select>  			
				</div>
				<div class="input-group abaixo">
			  		<span class="input-group-addon edits"><span class="glyphicon glyphicon-shopping-cart"></span></span>	
			  		<select id='curso' name='curso' class='form-control edits nuloOUvazio'> </select>
				</div>
				<div id="dias" class="input-group abaixo">
					<span class="input-group-addon">
						<span class="glyphicon"><img src="icons/glyphicons_231_sun.png">
							<input type="checkbox" id="dia[]" name="dia[]" value="0" class="edits"> Domingo						
							<input type="checkbox" id="dia[]" name="dia[]" value="1" class="edits"> Segunda
							<input type="checkbox" id="dia[]" name="dia[]" value="2" class="edits"> Terça
							<input type="checkbox" id="dia[]" name="dia[]" value="3" class="edits"> Quarta
							<input type="checkbox" id="dia[]" name="dia[]" value="4" class="edits"> Quinta
							<input type="checkbox" id="dia[]" name="dia[]" value="5" class="edits"> Sexta
							<input type="checkbox" id="dia[]" name="dia[]" value="6" class="edits"> Sábado
						</span>
					</span>					
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