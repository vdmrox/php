<?php
	if(isset($_SESSION['indice'])){
		$indice = $_SESSION['indice'];
		$nivel = lerNivelAcesso($indice);
		$conteudo = lerArquivo();
		$i = 0;
		if($nivel == 1){
			echo "<div style='width:98%;text-align:left;margin:auto;display:none;'><a style='text-decoration:none;' href='painelIndex.php?ac=inc'><input type='button' style='cursor:pointer;' value=' Inserir Novo '></a><br><br></div>";
			echo "<table align='center' cellspacing='0px' border='1px' width='98%'>";
			echo "<tr align='center' style='font-weight:bold;font-size:18px;color:#333;'>
					<td>Foto</td>
					<td>Nome</td>
					<td>Email</td>
					<td>Último Acesso</td>
					<td>Manutenção</td>
				  </tr>";
			foreach ($conteudo->usuario as $dados){
				$nome     = $dados->nome;
				$email    = $dados->email;
				$foto     = $dados->foto;
				$tempo    = $dados->logAtual;
				if(lerTempo($i) > 59616000){
					$data = "Nunca";
				}else{
					$data     = formatarDataLogin(lerTempo($i));
				}
				echo "<tr>
						<td align='center'><img src='$foto' height='50px'></td>
						<td class='grupoL'>$nome</td>
						<td class='grupoL'>$email</td>
						<td class='grupoL'>$data</td>
						<td align='center'><a href='painelIndex.php?ac=alt&ica=".$i."'>Alterar</a> <br> <a href='funcoes.php?acao=delUser&ice=".$i."'>Excluir</a></td>
					  </tr>";
				$i++;
			}
		}else if($nivel == 2){
			echo "<table align='center' cellspacing='1px' border='1px' width='98%'>";
			echo "<tr align='center' style='font-weight:bold;font-size:18px;color:#333;'>
					<td>Foto</td>
					<td>Nome</td>
					<td>Email</td>
					<td>Último Acesso</td>
					<td>Manutenção</td>
				  </tr>";
				$nome     = $conteudo->usuario[$indice]->nome;
				$email    = $conteudo->usuario[$indice]->email;
				$foto     = $conteudo->usuario[$indice]->foto;
				$tempo    = $dados->logAtual;
				if(lerTempo($indice) > 59616000){
					$data = "Nunca";
				}else{
					$data     = formatarDataLogin(lerTempo($indice));
				}
				echo "<tr>
						<td align='center'><img src='$foto' height='50px'></td>
						<td class='grupoL'>$nome</td>
						<td class='grupoL'>$email</td>
						<td class='grupoL'>$data</td>
						<td align='center'><a href='painelIndex.php?ac=alt&ica=".$indice."'>Alterar</a></td>
					  </tr>";
		} 
		echo "</table><br>";
	}
?>