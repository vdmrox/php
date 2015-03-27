    <?php
	if (isset($_SESSION['indice']) && lerNivelAcesso($_SESSION['indice']) == 2){
		alertaDireciona("Você não tem permissão para acessar esta página!", "painelIndex.php?ac=cmt");
	}else{
		$indPost = exibirComentarios();
	?>
		</table>
		<br>
		<div style="width:95%;margin:auto;text-align:right;"><a href='painelIndex.php?ac=edCmt&idinc=<?php echo $indPost; ?>' style='text-decoration:none'><input type='button' style='cursor:pointer;' id='cmtInc' name='cmtInc' value=' Incluir Novo '></a>
		 <a href="index.php" style="text-decoration:none;"><input style="cursor:pointer;" type="button" value=" Voltar "></a>
		</div>
		<br>
   <?php
	}
?>