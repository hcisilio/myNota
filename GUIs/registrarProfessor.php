<?php 
	session_start("mynota");
	if ($_SESSION["logado"] <> "true") {
		header("Location: login.php");
	}
	else if ( ($_SESSION["acesso"] == "Gerente") || ($_SESSION["acesso"] == "Administrador") ){
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
<title>Cadastrar professor</title>
<link rel="stylesheet" type="text/css" href="CSS/mynota.css">
<script>
   function doPost(formName) {
       var theForm = document.getElementById(formName);
       theForm.submit();
   }
</script>
</head>

<body>

	<div id="principal">

		<div id="topo">
			Topo da página
		</div>
		
		<div id="barra">
			<ul>
				<li> <a href="JavaScript:doPost('professor')"> <img src="Imagens/save.png"> </a></li>           
			</ul>
		</div>
		
		<div id="menu">
			<?php include("mainMenu.php"); ?>
		</div>
		
		<div id="formulario">
			<form id="professor" action="../Controladores/controlador.php" method="post">
				<input type="hidden" name="classe" value="Professor">
				<input type="hidden" name="metodo" value="inserir">
				<label> Login </label> <br>
				<input type="text" name="id" class="edits" size="21" maxlength="20"> <br/>
				<label>Nome Completo</label> <br>
				<input type="text" name="nome" class="edits" size="50" /> <br>
				<label>Senha</label> <br>
				<input type="password" name="senha" class="edits" size="50" /> <br>
				<label>Perfil de acesso</label> <br>
				<select name="acesso" class="edits">
					<option value="Professor"> Professor </option>
					<option value="Diretor"> Diretor </option>
					<option value="Administrador"> Administrador </option>
				</select>  <BR />
				<label>Comentários</label> <br>
				<textarea name="obs" cols="50" rows="5" class="edits"></textarea> <br>	
			</form>
		</div>
		
		<div class="clear"> <BR> </div>
		
		<div id="rodape">
			<p>I CS - Cisilio's Sistemas &copy;2014 - Todos os direitos reservados I <a href="#"></a> </p>
		</div>	

	</div>

</body>