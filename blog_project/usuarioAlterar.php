<?php
	if (isset($_SESSION['ica'])){
		$indice = intval($_SESSION['ica']);
		$acesso = lerNivelAcesso($_SESSION['indice']);
	
		if($acesso == 2 && $indice != $_SESSION['indice']){
			alertaDireciona("Você não tem permissão para acessar esta página!", "painelIndex.php?ac=msg");
		}else{

		$dados = lerArquivo();
		$nome = $dados->usuario[$indice]->nome;
		$email = $dados->usuario[$indice]->email;
		$senha = $dados->usuario[$indice]->senha;
		$foto = $dados->usuario[$indice]->foto;
		$nascimento = $dados->usuario[$indice]->nascimento;
		$cidade = $dados->usuario[$indice]->cidade;
		$estado = $dados->usuario[$indice]->estado;
	}
?>
<h6>&nbsp;</h6>
<div class="alteraUsuario">
    <h3>Alterar Cadastro - <?php echo $nome; ?></h3>
    
    <form action="funcoes.php?acao=alterar" method="post" id="inserir" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Nome:</td><td><input type="text" name="nome" id="nome" value="<?php echo $nome; ?>" ><br></td>
        </tr>
        <tr>
            <td>Email:</td> <td><input type="text" name="email" id="email" value="<?php echo $email; ?>"><br></td>
        </tr>
        <tr>
            <td>Senha:</td> <td><input type="password" name="senha" id="senha" value="<?php echo $senha; ?>"><br></td>
        </tr>
        <tr>
            <td>Foto:</td> <td><img height="100px" src="<?php echo $foto; ?>"><input type="hidden" id="fotoAntiga" name="fotoAntiga" value="<?php echo $foto; ?>"><br></td>
        </tr>
        <tr>
            <td>Alterar Foto:</td> <td><input style="cursor:pointer;" type="file" id="chFoto" name="chFoto" value="Atualizar Foto"><br></td>
        </tr>
        <tr>
            <td>Data de Nascimento:</td> <td><input type="text" name="nascimento" id="nascimento" value="<?php echo $nascimento; ?>"><br></td>
        </tr>
        <tr>
            <td>Cidade:</td> <td><input type="text" name="cidade" id="cidade" value="<?php echo $cidade; ?>"><br></td>
        </tr>
        <tr>
            <td>Estado:</td> <td><input type="text" name="estado" id="estado" value="<?php echo $estado; ?>"><br></td>
        </tr>
        <tr>
            <td>Nível Acesso:</td> <td>
				<?php
					if($acesso == 2){
						echo "<select name='nAcesso' id='nAcesso'>
								<option value='2'>Visitante</option>
							  </select>";
					}else{
						$indUser = lerNivelAcesso($indice);
						if($indUser == 1){
							$sl1 = "selected";
							$sl2 = "";
						}else{
							$sl2 = "selected";
							$sl1 = "";
						}
						echo "<select name='nAcesso' id='nAcesso'>
								<option $sl1 value='1'>Administrador</option>
								<option $sl2 value='2'>Visitante</option>
							  </select>";
					}
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="hidden" id="indiceItem" name="indiceItem" value="<?php echo $indice; ?>"> <input style="cursor:pointer;" type="submit" value=" Alterar " >&nbsp;&nbsp;<a href="painelIndex.php?ac=usr" style="text-decoration:none;"><input style="cursor:pointer;" type="button" value=" Voltar "></a></td>
        </tr>
    </table>
    </form>
</div><br>
<?php
	}
?>