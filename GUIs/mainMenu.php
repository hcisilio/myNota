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
<div class="list-group">
	<a href="<?php echo "home$acesso.php"; ?>" class="list-group-item active"> Página Inicial </a>
  	<?php include("opcoes$acesso.php"); ?>
</div>