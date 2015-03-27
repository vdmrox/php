<?php
	@session_start();
	include "funcoes.php";
	if(isset($_SESSION['indice'])){
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Painel de Administração</title>
<link href="estilo.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
		$nivel    = lerNivelAcesso($_SESSION['indice']);
		$nome     = lerNome($_SESSION['indice']);
		$ultLogin = formatarDataLogin(lerTempo($_SESSION['indice']));
	?>
	<div id="adminConteudo">
		<div id="adminCabecalho">PAINEL DE ADMINISTRAÇÃO</div>
		<div id="adminUsuario"><a style="text-decoration:none;" href="index.php"><input type="button" value=" Voltar para Principal "></a>&nbsp;<?php echo "Seja bem vindo, ".$nome; echo ". Seu último acesso foi a ".$ultLogin; ?> <a style="text-decoration:none;" href="painelSair.php"><input type="button" value=" Sair "></a> </div>
		<div>
			<a href="painelIndex.php?ac=usr"><div class="adminMenu">Dados de Usuário</div></a>
			<a href="painelIndex.php?ac=msg"><div class="adminMenu" style="border-left:1px solid #333;">Gerenciar Postagens</div></a>
			<a href="painelIndex.php?ac=cmt"><div class="adminMenu" style="border-left:1px solid #333;">Gerenciar Comentários</div></a>
		</div>
	<?php
	//	exibirAlerta($_SESSION['nAcesso']);
		if(isset($_GET['ac']) && $nivel > 0){
			if($_GET['ac'] == "usr"){
				echo "<h2>Gerenciamento de Usuários</h2>";
					include "usuarioExibir.php";
			}else if($_GET['ac'] == "alt"){
				if(isset($_GET['ica'])){
					$_SESSION['ica'] = $_GET['ica'];
					include "usuarioAlterar.php";
				}
			}else if($_GET['ac'] == "inc"){
				include "usuarioIncluir.php";
			}else if($_GET['ac'] == "incPost"){
				include "postIncluir.php";
			}else if($_GET['ac'] == "msg"){
				echo "<h2>Gerenciamento de Postagens</h2>";
				echo "<div style='width:98%;text-align:left;margin:auto;'><a style='text-decoration:none;' href='painelIndex.php?ac=incPost'><input type='button' style='cursor:pointer;' value=' Inserir Novo '></a><br><br></div>";
				if($nivel == 1){
					include "postExibir.php";
				}
			}else if($_GET['ac'] == "altP"){
				if(isset($_GET['idP'])){
					$_SESSION['idP'] = $_GET['idP'];
					include "postAlterar.php";
				}
			}else if($_GET['ac'] == "cmt"){
				echo "<h2>Gerenciamento de Comentários</h2>";
				include "comentIndex.php";
			}else if($_GET['ac'] == "edCmt"){
				if(isset($_GET['idcm'])){
					$_SESSION['idcm'] = $_GET['idcm'];
					include "comentExibir.php";
				}else if(!isset($_GET['idcmA']) && isset($_GET['idinc'])){
					$_SESSION['idinc'] = $_GET['idinc'];
					include "comentIncluir.php";
				}else if(isset($_GET['idcmA']) && isset($_GET['idinc'])){
					$_SESSION['idcmA'] = $_GET['idcmA'];
					$_SESSION['idinc'] = $_GET['idinc'];
					include "comentAlterar.php";
				}
			}else{
				echo "<p>&nbsp;<br>Seja bem vindo ao painel Administrativo do Blog.<br><br>Clique em uma das opções acima para executar alguma ação!</p>";
			}
		}
	?>
	</div>
   </body>
</html>
   <?php
	}else{
		alertaDireciona("Você não tem permissão para acessar esta página!", "painelSair.php");
	}
	?>
