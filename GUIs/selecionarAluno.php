<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="stylesheet" media="screen" type="text/css" title="style" href="CSS/style-popup.css" />
<title>Selecionar Aluno</title>
</head>
<body>
<div id="shadow">
	<form name='buscarAluno' action='../Controladores/controlador.php' method='get'>			
		<input type="hidden" name="classe" value="Aluno">
		<input type="hidden" name="metodo" value="buscar">
		<ul id="menu">
			<li> <input type='submit' name='btnBuscar' value='Buscar' class="linkSubmit">
		</ul>	
		<div id="conteudo">		
			<label> Nome ou Matrícula </label><BR />
			<input type='text' name='q' size='15'> <font class="obs"> Obs.: Deixe em branco para buscar todos os alunos </font>
		</div>			
	</form>	
	<div class="clear"></div>
</div>
<div id="footer">
  <p>I CS - Cisilio's Sistemas &copy;2013 - Todos os direitos reservados I <a href="#"></a> </p>
</div>
</body>
</html>