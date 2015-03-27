<?php
	$nivel = lerNivelAcesso($_SESSION['indice']);
	if($nivel != 1){
		alertaDireciona("Você não tem permissão para acessar esta página!", "painelIndex.php");
	}else{
?>
<h6>&nbsp;</h6>
<div class="alteraUsuario">
    <h3>Incluir Cadastro</h3>
    <form action="funcoes.php?acao=incluir" method="post" id="incluir" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Nome:</td><td><input type="text" name="nome" id="nome"><br></td>
        </tr>
        <tr>
            <td>Email:</td> <td><input type="text" name="email" id="email"><br></td>
        </tr>
        <tr>
            <td>Senha:</td> <td><input type="password" name="senha" id="senha" ><br></td>
        </tr>
        <tr>
            <td>Foto:</td> <td><input type="file" id="chFoto" name="chFoto" value="Atualizar Foto"><br></td>
        </tr>
        <tr>
            <td>Data de Nascimento:</td> <td><input type="text" name="nascimento" id="nascimento"><br></td>
        </tr>
        <tr>
            <td>Cidade:</td> <td><input type="text" name="cidade" id="cidade" ><br></td>
        </tr>
        <tr>
            <td>Estado:</td> <td><input type="text" name="estado" id="estado"><br></td>
        </tr>
        <tr>
             <td>Nível Acesso:</td> <td>
                    <?php
                        echo "<select name='nAcesso' id='nAcesso'>
                                <option value='2'>Visitante</option>
                              </select>";
                    ?>
                </td>
        </tr>
        <tr>
            <td colspan="2" align="center"> <input type="submit" value=" Incluir " >&nbsp;&nbsp;<a href="painelIndex.php?ac=usr" style="text-decoration:none;"><input style="cursor:pointer;" type="button" value=" Voltar "></a></td>
        </tr>
    </table>
    </form>
</div><br>
<?php
	}
?>