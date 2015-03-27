<?php
	@session_start();
//	include "funcoes.php";
	if(!isset($_SESSION['indice'])){
		alertaDireciona("Você não tem permissão para acessar esta página!", "painelIndex.php");
	}else{
		if(isset($_SESSION['idinc'])){
			$indice = intval($_SESSION['idinc']);
			echo "&nbsp;<br><div class='alteraPost' style='width:95%;margin:auto;border:0px;'>";
			echo "<table border='1px' width='100%' align='center'>";
				exibirPostagemIndividual($indice);
			echo "</table>";
?>
<h3>Incluir Comentário</h3>
<table border="0px" cellpadding="0px" cellspacing="0px">
    <form id="cmtCad" name="cmtCad" action="funcoes.php?acao=insertcmt" method="post">
        <tr><td><textarea id="cmtContent" name="cmtContent" cols="62" rows="5"></textarea><input type="hidden" value="<?php echo $indice; ?>" name="cmtIndice" id="cmtIndice"></td></tr>
        <tr>
        	<td align="right">
        	<input type="submit" id="cmtSend" name="cmtSend" value="Incluir">&nbsp;&nbsp;<input type="reset" value="Limpar">&nbsp;&nbsp;<a href="painelIndex.php?ac=cmt" style="text-decoration:none;"><input style="cursor:pointer;" type="button" value=" Voltar "></a>
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