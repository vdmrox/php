<?php
//	@session_start();
// include "funcoes.php";
	if(!isset($_SESSION['indice'])){
		alertaDireciona("Você não tem permissão para acessar esta página!", "painelIndex.php");
	}else{
		if(isset($_SESSION['idcmA'])){
			$indicePost = intval($_SESSION['idinc']);
			$indiceComt = intval($_SESSION['idcmA']);
			$dados = lerArquivoCmt();

			$conteudo   = $dados->comentario[$indiceComt]->conteudo;

			echo "&nbsp;<br><div class='alteraPost' style='width:95%;margin:auto;border:0px;'>";
			echo "<table border='1px' width='100%' align='center'>";
				exibirPostagemIndividual($indicePost);
			echo "</table>";
?>
<h3>Alterar Comentário</h3>
<table border="0px" cellpadding="0px" cellspacing="0px">
    <form id="cmtAlt" name="cmtAlt" action="funcoes.php?acao=alteraCmt" method="post">
        <tr><td><textarea id="cmtContent" name="cmtContent" cols="62" rows="5"><?php echo $conteudo; ?></textarea><input type="hidden" value="<?php echo $indiceComt; ?>" name="cmtIndice" id="cmtIndice"></td></tr>
        <tr>
        	<td align="right">
        	<input type="submit" id="cmtSend" name="cmtSend" value="Alterar">&nbsp;&nbsp;<input type="reset" value="Limpar">&nbsp;&nbsp;<a href="painelIndex.php?ac=edCmt&idcm=<?php echo $indicePost;?>" style="text-decoration:none;"><input style="cursor:pointer;" type="button" value=" Voltar "></a>
            </td>
        </tr>
    </form>
</table>
</div><br>
<?php
		}else{
			alertaDireciona("Não foi possível identificar a Postagem!", "painelIndex.php");
		}
	}
?>