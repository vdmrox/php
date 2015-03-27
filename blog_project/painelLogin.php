<?php
	session_start();
	include "funcoes.php";
	$conteudo = lerArquivo();
	$i=0;
	foreach($conteudo->usuario as $dados)
	{
		if($dados->email == $_POST['usuario_blog'] && $dados->senha == $_POST['senha_blog']){
			$_SESSION['indice'] = $i;
			alteraDataLogin($i);
		}
		$i++;
	}
	if(isset($_SESSION['indice'])){
		direcionaPagina("index.php");	
	}else{
		alertaDireciona("Você não tem permissão para acessar esta página!", "painelSair.php");
	}
?>