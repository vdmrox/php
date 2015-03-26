<?php

function encriptar($string, $chave){

	$retorno = "";

	for($i=0;$i<strlen($string);$i++){
		if($string[$i] != " "){
			if((ord($string[$i]) + $chave) > 122){
				$caracter = (ord($string[$i]) - (26 - $chave));
			}else{
				$caracter = (ord($string[$i]) + $chave);
			}
			$caracter = chr($caracter);
		}else{
			$caracter = " ";
		}
		$retorno .= $caracter;
	}

	return $retorno;

}

function decriptar($string, $chave){

	$string = $_POST['newstring'];

	$retorno = "";

	for($i=0;$i<strlen($string);$i++){
		if($string[$i] != " "){
			if((ord($string[$i]) - $chave) < 97){
				$caracter = (ord($string[$i]) + (26 - $chave));
			}else {
				$caracter = (ord($string[$i]) - $chave);
			}
			$caracter = chr($caracter);
		}else{
			$caracter = " ";
		}
		$retorno .= $caracter;
	}

	return $retorno;

}

?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
		<form action="<?php $PHP_SELF; ?>" name="form1" method="POST">
			<h2>Digite o texto aqui: <input type="text" name="conteudo" <?php if(isset($_POST['conteudo'])){ echo " value='".$_POST['conteudo']."' ";}  ?>></h2>
			<h2>Digite a chave aqui (n˚ inteiro): <input type="text" name="chave" <?php if(isset($_POST['chave'])){ echo " value='".$_POST['chave']."' ";}  ?>></h2>
			<input type="hidden" name="newstring" value="<?php echo encriptar($_POST['conteudo'], $_POST['chave']); ?>">
			<input type="submit" name="acao" value=" Encriptar "><br>
			<input type="submit" name="acao" value=" Decriptar "><br>
		</form>

		<?php 

		if(isset($_POST['acao'])){
			$conteudo = $_POST['conteudo'];
			$chave    = $_POST['chave'];
			$acao     = $_POST['acao'];

			if(trim($acao) == 'Encriptar'){
				echo "<h2>Conteúdo Encriptado: </h2>".encriptar($conteudo, $chave);
			}else if(trim($acao) == 'Decriptar'){
				echo "<h2>Conteúdo Decriptado: </h2>".decriptar($conteudo, $chave);
			}else{
			}
		}

		?>
	</body>
</html>