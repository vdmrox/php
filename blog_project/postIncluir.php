<?php
	if(!isset($_SESSION['indice'])){
		alertaDireciona("Você não tem permissão para acessar esta página!", "painelIndex.php");
	}else{
?>
<h6>&nbsp;</h6>
<div class="alteraPost">
<h3>Incluir Postagem</h3>
<table border="0px" cellpadding="0px" cellspacing="0px" >
    <form id="postCad" name="postCad" action="funcoes.php?acao=insertpost" method="post">
    	<tr><td>Tipo de Postagem</td>
        	<td>
                <select name="tpostagem">
                	<option value="dicas">Dicas</option>
                    <option value="noticias">Noticias</option>
                    <option value="review">Review</option>
                    <option value="shows">Shows</option>
                </select></td>
        </tr>
        <tr><td align="right">Título do Post: </td><td><input type="text" id="postTitulo" name="postTitulo" size="81px"></td></tr>
        <tr><td align="right">Conteúdo do Post: </td><td><textarea id="postContent" name="postContent" cols="62" rows="5"></textarea></td></tr>
        <tr>
        	<td colspan="2" align="right">
        	<input type="submit" id="postSend" name="postSend" value="Cadastrar">&nbsp;&nbsp;<input type="reset" value="Limpar">&nbsp;&nbsp;<a href="painelIndex.php?ac=msg" style="text-decoration:none;"><input style="cursor:pointer;" type="button" value=" Voltar "></a>
            </td>
        </tr>
    </form>
</table>
</div><br>
<?php
	}
?>