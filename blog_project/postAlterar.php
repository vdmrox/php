<?php
if (isset($_SESSION['idP'])){
	$indice = intval($_SESSION['idP']);
	$acesso = lerNivelAcesso($_SESSION['indice']);
		
	if($acesso != 1){
		alertaDireciona("Você não tem permissão para acessar esta página!", "painelIndex.php?ac=msg");
	}else{

	$dados = lerArquivoPost();
	$postTitulo		= $dados->postagem[$indice]->titulo;
	$postContent	= $dados->postagem[$indice]->conteudo;
	$postTipo       = $dados->postagem[$indice]->tipoPostagem;
	
	if($postTipo == "dicas"){
		$t1 = "selected";$t2 = "";$t3 = "";$t4 = "";
	}
	if($postTipo == "noticias"){
		$t1 = "";$t2 = "selected";$t3 = "";$t4 = "";
	}
	if($postTipo == "review"){
		$t1 = "";$t2 = "";$t3 = "selected";$t4 = "";
	}
	if($postTipo == "shows"){
		$t1 = "";$t2 = "";$t3 = "";$t4 = "selected";
	}
}
?>
<h2>Edição de postagem: <?php echo $postTitulo; ?></h2>
<div id="admPostContainer">
    <table>
        <form id="admPostCad" name="admPostCad" action="funcoes.php?acao=editpost" method="post">
        	<tr><td>Tipo de Postagem</td>
                <td>
                    <select name="tpostagem">
                        <option <?php echo $t1; ?> value="dicas">Dicas</option>
                        <option <?php echo $t2; ?> value="noticias">Noticias</option>
                        <option <?php echo $t3; ?> value="review">Review</option>
                        <option <?php echo $t4; ?> value="shows">Shows</option>
                    </select></td>
            </tr>
            <tr><td>Título do post</td><td><input type="text" id="postTitulo" name="postTitulo" size="81px" value="<?php echo $postTitulo; ?>"></td></tr>
            <tr><td>Conteúdo do Post</td><td><textarea id="postContent" name="postContent" cols="62" rows="5"><?php echo $postContent; ?></textarea></td></tr>
            <tr>
                <td colspan="2" align="right">
                <input type="submit" id="postSend" name="postSend" value="Alterar">
                <input type="reset" value="Limpar">&nbsp;&nbsp;<a href="painelIndex.php?ac=msg" style="text-decoration:none;"><input style="cursor:pointer;" type="button" value=" Voltar "></a>
                </td>
            </tr>
        </form>
    </table>
</div>

<?php
	}
?>