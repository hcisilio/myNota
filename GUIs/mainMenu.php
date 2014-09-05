<?php 
	session_start("mynota");
 	
	if ($_SESSION["logado"] <> "true") {
		header("Location: login.php");
	}
	else {
		$acesso = $_SESSION["acesso"];
		$nome = $_SESSION["nome"];
	}
	

?>
<ul>
	<li><a href="<?php echo "home$acesso.php"; ?>">Página Inicial</a></li>
	<?php include("opcoes$acesso.php"); ?>
</ul>
