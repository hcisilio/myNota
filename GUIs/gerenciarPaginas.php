<?php 
	include_once ("../Controladores/controladorPermissao.php");
	$persistir = new ControladorPermissao();
	$persistir->autorizarAcesso( end(explode("/", $_SERVER['PHP_SELF'])) );
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   	<title>Gerenciamento de acesso as páginas</title>
   	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link href="css/bootstrap.css" rel="stylesheet">	
	<script src="js/jQuery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/validacoes.js"></script>
	<script>
		function registrar() {
		   if ( nuloOUvazio("#paginas") ) {
		       $.ajax({			        
					type: "POST",
					url: "../Controladores/controlador.php",
					data: { 
						pagina: $("#pagina").val(),
						descricao: $("#descricao").val(),
						nivel: $("#nivel").val(),
						ordem: $("#ordem").val(),
						classe: "Permissao",
						metodo: "inserir" 
					},
					success: function(resultado) {
						location.reload();
						$('#alerta').hide();				
						$('#alerta').html(resultado);
						$('#alerta').show("slow");
					},
					error: function() {				
						$('#alerta').html('fudeu');
					}
			    });
		   }
	   	}
		function atualizar(linha) {
		   if ( nuloOUvazio("#paginas"+linha) ) {			   
		       $.ajax({			        
					type: "POST",
					url: "../Controladores/controlador.php",
					data: { 
						pagina: $("#pagina"+linha).val(),
						descricao: $("#descricao"+linha).val(),
						nivel: $("#nivel"+linha).val(),
						ordem: $("#ordem"+linha).val(),
						classe: "Permissao",
						metodo: "alterar" 
					},
					success: function(resultado) {
						$('#alerta').hide();				
						$('#alerta').html(resultado);
						$('#alerta').show("slow");
					},
					error: function(resultado) {				
						
					}
			    });
		   }
	   	}
		function deletar(linha){
			$.ajax({			        
				type: "POST",
				url: "../Controladores/controlador.php",
				data: { 
					pagina: $("#pagina"+linha).val(),
					classe: "Permissao",
					metodo: "deletar" 
				},
				success: function(resultado) {
					location.reload();
					$('#alerta').hide();				
					$('#alerta').html(resultado);
					$('#alerta').show("slow");
				},
				error: function(resultado) {				
					
				}
		    });
		}
  	</script>
</head>
<body>
	<!-- NavBar -->
	<nav class="navbar navbar-default" role="navigation" id="barra">
		<div class="container-fluid">
			<div class="navbar-header">	
				<a class="navbar-brand" href="../GUIs/home.php"> <img alt="Brand" src="Imagens/sublogo_branco.png"> </a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li> <a href="" data-toggle="modal" data-target="#registrarNovaPagina"> <img src="Imagens/new-page.png"> </a></li>
				</ul>
			</div>
		</div>
	</nav>
	
	<!-- Modal -->
	<div class="modal fade" id="registrarNovaPagina" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		 <div class="modal-content">
		   <div class="modal-header">
		     <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		     <h4 class="modal-title" id="myModalLabel">Registrar nova página</h4>
		   </div>
		   <div class="modal-body">
		   	<table border='1' class='table table-striped tabela-consulta'>
				<tr>
					<th>Nome do Arquivo</th>
					<th>Descrição</th>
					<th>Nível de acesso</th>
					<th>Ordem no menu</th>
					<th>  </th>
				</tr>
				<form id='paginas' class='form-inline' role='form' method='GET'>
				<div class="input-group abaixo"> 		
					<td><input id='pagina' class='edits nuloOUvazio' type='text' placeholder="Nome do arquivo .php"></td>
					<td><input id='descricao' class='edits nuloOUvazio' type='text' placeholder="Descriçao para o menu"></td>
					<td><input id='nivel' class='edits nuloOUvazio' size='10' type='text' placeholder="Nível de acesso a página"></td>
					<td><input id='ordem' class='edits nuloOUvazio' size='10' type='text' placeholder="Ordem no menu"></td>
					<td><a href='JavaScript:registrar()'> <img src='Imagens/save.png' height='28'> </a></td>								  	
			  	</div>			  	
				</form>
			 </table>			
		   </div>
		 </div>
	  </div>
	</div>
	
	<div id="row">
		<!-- menu lateral -->
		<div class="col-md-3 menuLateral">
			<div class="list-group">				
			  	<?php $persistir->criarMenu() ?>
			</div>
		</div>
		<!-- espaçamento -->
		<div class="col-md-1">
		</div>
		<!-- conteúdo -->
		<div class="col-md-7 abaixo">	
			<div id='alerta'></div>
			<table border='1' class='table table-striped tabela-consulta'>
				<tr>
					<th>Nome do Arquivo</th>
					<th>Descrição</th>
					<th>Nível de acesso</th>
					<th>Ordem no menu</th>
					<th>  </th>
					<th>  </th>
				</tr>
				<?php $persistir->gerenciarPaginas() ?>
			</table>	
		</div>	
		<!-- sobra -->
		<div class="col-md-1">
		</div>
	</div>
	
	<!-- rodapé -->
	<?php include ("rodape.php") ?>

</body>
</html>