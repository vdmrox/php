<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
$arquivo     = "bd_usuarios.xml";
$arquivoPost = "bd_post.xml";
$arquivoCmt  = "bd_comentario.xml";
$arquivoCur  = "bd_curtir.xml";
function lerArquivo(){
	return simplexml_load_file("bd_usuarios.xml");
}
function lerArquivoPost(){
	return simplexml_load_file("bd_post.xml");
}
function lerArquivoCmt(){
	return simplexml_load_file("bd_comentario.xml");
}
function lerArquivoCur(){
	return simplexml_load_file("bd_curtir.xml");
}
if(isset($_GET['acao']) && $_GET['acao'] == "curtir" && isset($_GET['indice'])){
		$dados = lerArquivoCur();
		$ins = $dados->addChild("postagem");
		$ins->addChild("curtida",1);
		$ins->addChild("indice",intval($_GET['indice']));
		file_put_contents($arquivoCur, $dados->asXML());
		direcionaPagina("index.php");
}
function lerNome($indice){
	$conteudo = lerArquivo();
	return $conteudo->usuario[$indice]->nome;
}
function lerEmail($indice){
	$conteudo = lerArquivo();
	return $conteudo->usuario[$indice]->email;
}
function lerNivelAcesso($indice){
	$conteudo = lerArquivo();
	return $conteudo->usuario[$indice]->nAcesso;
}
function lerTempo($indice){
	$conteudo = lerArquivo();
	return (time() - $conteudo->usuario[$indice]->logAtual);
}
function alteraDataLogin($indice){
	$dados = lerArquivo();
	$dados->usuario[$indice]->logAtual = time();
	file_put_contents("bd_usuarios.xml", $dados->asXML());
}
function formatarDataLogin($data){
	$retorno = "";
	if($data > 2592000){
		$meses = $data / 2592000;
		$data = $data-(intval($meses)*2592000);
		if(intval($meses) == 1){
			$retorno .= intval($meses) . " mês ";
		}else{
			$retorno .= intval($meses) . " meses ";
		}
	}
	if($data > 86400){
		$dias = $data / 86400;
		$data = $data-(intval($dias)*86400);
		if(intval($dias) == 1){
			$retorno .= intval($dias) . " dia ";
		}else{
			$retorno .= intval($dias) . " dias ";
		}
	}
	if($data >= 3600){
		$horas = $data / 3600;
		$data = $data-(intval($horas)*3600);
		if(intval($horas) == 1){
			$retorno .= intval($horas) . " hora ";
		}else{
			$retorno .= intval($horas) . " horas ";
		}
	}
	if($data >= 60){
		$minutos = $data / 60;
		$data = $data-(intval($minutos)*60);
		if(intval($minutos) == 1){
			$retorno .= intval($minutos) . " minuto ";
		}else{
			$retorno .= intval($minutos) . " minutos ";
		}
	}
	if($data < 60){
		$retorno .= intval($data) . " segundos.";
	}
	return $retorno;
}
function exibirAlerta($mensagem){
	echo "<script type=\"text/javascript\">";
	echo "alert('".$mensagem."');";
	echo "</script>";
}
function direcionaPagina($pagina){
	echo "<script type=\"text/javascript\">";
	echo "document.location=('".$pagina."');";
	echo "</script>";
}
function alertaDireciona($mensagem, $pagina){
	exibirAlerta($mensagem);
	direcionaPagina($pagina);
}
// Faz upload do arquivo ($arquivo) para a pasta $caminho (uploads/)
function upload($arquivo,$caminho){
	if(!(empty($arquivo))){
		$arquivo1 = $arquivo;
		$arquivo_minusculo = strtolower($arquivo1['name']);
		$caracteres = array("ç","~","^","]","[","{","}",";",":","´",",",">","<","-","/","|","@","$","%","ã","â","á","à","é","è","ó","ò","+","=","*","&","(",")","!","#","?","`","ã"," ","©");
		$arquivo_tratado = str_replace($caracteres,"",$arquivo_minusculo);
		$destino = $caminho.$arquivo_tratado;
		if(!move_uploaded_file($arquivo1['tmp_name'],$destino)){
			echo "<script>window.alert('Erro ao enviar o arquivo');</script>";
		}
		return $destino;
	}
}
// Apaga o arquivo importado 
function apagaArquivo($caminho){
	$deletarArquivo = unlink($caminho);
	if(!$deletarArquivo){
		echo "<script>window.alert('Erro ao remover Arquivo!');</script>";
	}
}
if(isset($_GET['acao']) && $_GET['acao'] == "alterar"){
		@session_start();
		if(isset($_SESSION['ica'])){
			$indice		= intval($_SESSION['ica']);
			$nome		= $_POST['nome'];
			$email		= $_POST['email'];
			$senha		= $_POST['senha'];
			$nascimento	= $_POST['nascimento'];
			$cidade		= $_POST['cidade'];
			$estado		= $_POST['estado'];
			$nAcesso    = $_POST['nAcesso'];
			$fotoAntiga = $_POST['fotoAntiga'];
			$novaFoto   = $_FILES['chFoto']['name'];
			
			$dados = lerArquivo();
			$dados->usuario[$indice]->nome = $nome;
			$dados->usuario[$indice]->email = $email;
			$dados->usuario[$indice]->senha = $senha;
			if($novaFoto != ""){
				apagaArquivo($fotoAntiga);
				$caminho    = upload($_FILES['chFoto'], "img/");
				$dados->usuario[$indice]->foto = $caminho;
			}
			$dados->usuario[$indice]->nascimento = $nascimento;
			$dados->usuario[$indice]->cidade = $cidade;
			$dados->usuario[$indice]->estado = $estado;
			$dados->usuario[$indice]->nAcesso = $nAcesso;
			file_put_contents($arquivo, $dados->asXML());
			header("Location: painelIndex.php?ac=usr");
		}else{
			alertaDireciona("Còdigo do item não informado!", "painelIndex.php?ac=usr");
		}
}
if(isset($_GET['acao']) && $_GET['acao'] == "incluir"){
		$nome	   = $_POST['nome'];
		$email	  = $_POST['email'];
		$senha	  = $_POST['senha'];
		$nascimento = $_POST['nascimento'];
		$cidade	 = $_POST['cidade'];
		$estado	 = $_POST['estado'];
		$nAcesso    = $_POST['nAcesso'];
		$novaFoto   = $_FILES['chFoto']['name'];

		$dados = lerArquivo();
		$ins = $dados->addChild("usuario");
		$ins->addChild("nome",$nome);
		$ins->addChild("email",$email);
		$ins->addChild("senha",$senha);
		$caminho    = upload($_FILES['chFoto'], "img/");
		$ins->addChild("foto",$caminho);
		$ins->addChild("nascimento",$nascimento);
		$ins->addChild("cidade",$cidade);
		$ins->addChild("estado",$estado);
		$ins->addChild("nAcesso",$nAcesso);
		file_put_contents($arquivo, $dados->asXML());
		alertaDireciona("Cadastro efetuado com sucesso!", "index.php");
}
if(isset($_GET['acao']) && $_GET['acao'] == "insertpost"){
	@session_start();
	$postTitulo    = $_POST['postTitulo'];
	$postContent   = $_POST['postContent'];
	$dataFormatada = date("d/m/Y H:i:s");
 	$tipoPostagem  = $_POST['tpostagem'];
	$nome          = lerNome($_SESSION['indice']);
	
	$dados = lerArquivoPost();
	$postIns = $dados -> addChild("postagem");
	$postIns -> addChild("titulo",$postTitulo);
	$postIns -> addChild("conteudo",$postContent);
	$postIns->  addChild("data", $dataFormatada);
	$postIns->  addChild("tipoPostagem", $tipoPostagem);
	$postIns->  addChild("nomePost", $nome);
	file_put_contents($arquivoPost, $dados->asXML());
	direcionaPagina("painelIndex.php?ac=msg");
}
if(isset($_GET['acao']) && $_GET['acao'] == "editpost"){
	@session_start();
	if(isset($_SESSION['idP'])){
		$indice 		= intval($_SESSION['idP']);
		$postTitulo		= $_POST['postTitulo'];
		$postContent	= $_POST['postContent'];
		$postTipo       = $_POST['tpostagem'];
		
		$dados = lerArquivoPost();
		$dados->postagem[$indice]->titulo = $postTitulo;
		$dados->postagem[$indice]->conteudo = $postContent;
		$dados->postagem[$indice]->tipoPostagem = $postTipo;
		file_put_contents($arquivoPost, $dados->asXML());
		alertaDireciona("Dados alterados com sucesso!", "painelIndex.php?ac=msg");
	}else{
		echo "Código do item inválido ou não informado corretamente.";
	}
}

if(isset($_GET['acao']) && $_GET['acao'] == "delete"){
	@session_start();
	$acesso = lerNivelAcesso($_SESSION['indice']);
	if($acesso != 1){
		alertaDireciona("Você não tem permissão para acessar esta página!", "painelIndex.php?ac=msg");
	}else{
		if(isset($_GET['indice'])){
			$i = intval($_GET['indice']);
			$dados = lerArquivoPost();
			unset($dados->postagem[$i]);
			file_put_contents($arquivoPost, $dados->asXML());
			alertaDireciona("Postagem apagada com sucesso!", "painelIndex.php?ac=msg");
		}
	}
}
if(isset($_GET['acao']) && $_GET['acao'] == "delUser"){
	@session_start();
	$acesso = lerNivelAcesso($_SESSION['indice']);
	if($acesso != 1){
		alertaDireciona("Você não tem permissão para acessar esta página!", "painelIndex.php?ac=usr");
	}else{
		if(isset($_GET['ice'])){
			$i = intval($_GET['ice']);
			$dados = lerArquivo();
			unset($dados->usuario[$i]);
			file_put_contents($arquivo, $dados->asXML());
			alertaDireciona("Usuário apagado com sucesso!", "painelIndex.php?ac=usr");
		}
	}
}
if(isset($_GET['acao']) && $_GET['acao'] == "delComt"){
	@session_start();
	$acesso = lerNivelAcesso($_SESSION['indice']);
	if($acesso != 1){
		alertaDireciona("Você não tem permissão para acessar esta página!", "painelIndex.php?ac=cmt");
	}else{
		if(isset($_GET['iccmt'])){
			$i = intval($_GET['iccmt']);
			$dados = lerArquivoCmt();
			$post = ($_SESSION['idcm']);
			unset($dados->comentario[$i]);
			file_put_contents($arquivoCmt, $dados->asXML());
			alertaDireciona("Comentário apagado com sucesso!", "painelIndex.php?ac=edCmt&idcm=$post");
		}
	}
}
if(isset($_GET['acao']) && $_GET['acao'] == "insertcmt"){
	@session_start();
	if(isset($_SESSION['indice'])){
		$nome          = lerNome($_SESSION['indice']);
		$conteudoCmt   = $_POST['cmtContent'];
		$indiceCmt     = $_POST['cmtIndice'];
		$dataFormatada = date("d/m/Y H:i:s");
		
		$dados = lerArquivoCmt();
		$postIns = $dados -> addChild("comentario");
		$postIns-> addChild("indicePost",$indiceCmt);
		$postIns-> addChild("conteudo",$conteudoCmt);
		$postIns-> addChild("data", $dataFormatada);
		$postIns-> addChild("usuarioPost", $nome);
		file_put_contents($arquivoCmt, $dados->asXML());

		direcionaPagina("painelIndex.php?ac=cmt");
	}else{
		alertaDireciona("Você não tem permissão para acessar esta página!", "painelIndex.php?ac=cmt");
	}
}
if(isset($_GET['acao']) && $_GET['acao'] == "alteraCmt"){
	@session_start();
	if(isset($_SESSION['indice'])){
		$indUser = intval($_SESSION['indice']);
		$nivel = lerNivelAcesso($indUser);
		if(isset($_POST['cmtIndice']) && $nivel == 1){
			$ind = intval($_POST['cmtIndice']);
			$dados=lerArquivoCmt();
			$dados->comentario[$ind]->conteudo = $_POST['cmtContent'];
			$indPost = $dados->comentario[$ind]->indicePost;
			file_put_contents($arquivoCmt, $dados->asXML());
			alertaDireciona("Comentário alterado com sucesso!", "painelIndex.php?ac=edCmt&idcm=".$indPost);
		}else{
			alertaDireciona("Não foi possível encontrar o item desejado!", "painelIndex.php?ac=cmt");
		}
	}else{
		alertaDireciona("Você não tem permissão para acessar esta página!", "painelIndex.php?ac=cmt");
	}
}
function exibirComentarios(){
	@session_start();
	if(isset($_SESSION['indice'])){
		if(isset($_SESSION['idcm'])){
			$indPost = intval($_SESSION['idcm']);
			$dados = lerArquivoPost();
	
			$postTitulo    = $dados->postagem[$indPost]->titulo;
			$postContent   = $dados->postagem[$indPost]->conteudo;
			$postData      = $dados->postagem[$indPost]->data;
			$postTipo      = $dados->postagem[$indPost]->tipoPostagem;
					
			echo "&nbsp;<br><table border='1px' width='95%' align='center'><tr style='font-weight:bold' >
					<td align='center'>Título</td>
					<td align='center'>Conteúdo da Postagem</td>
					<td align='center'>Data</td>
					<td align='center'>Categoria</td>
				  </tr>";
			echo "<tr>
					<td align='left'>$postTitulo</td>
					<td align='left'>$postContent</td>
					<td align='center'>$postData</td>
					<td align='center'>$postTipo</td>
				  </tr></table><br>";
			$dados = lerArquivoCmt();
			$quantInd = array();
			$j=0;
			$k=0;
			foreach($dados->comentario as $cmt){
				$ind = intval($cmt->indicePost);
				if($ind == $indPost){
					$quantInd[$j] = $k;
					$j++;
				}
				$k++;
			}
			if(count($quantInd) == 0){
				echo "<table border='0px' width='95%' align='center'><tr><td>Não existem comentários para esta Postagem!</td></tr></table>";
			}else{
				echo "<table border='1px' width='95%' align='center'><tr style='font-weight:bold'><td align='center'>Comentários</td>";
				if(lerNivelAcesso(intval($_SESSION['indice'])) == 1){
					echo "<td align='center'>Manutenção</td></tr>";
				}
				for ($i=count($quantInd)-1; $i>=0; $i--){
					$pos = $quantInd[$i];
					$nome = $dados->comentario[$pos]->usuarioPost;
					$data = $dados->comentario[$pos]->data;
					$conteudo = $dados->comentario[$pos]->conteudo;
					echo "<tr><td>$nome - $data<br>$conteudo</td>";
					if(lerNivelAcesso(intval($_SESSION['indice'])) == 1){
						echo "<td align='center'><a href='painelIndex.php?ac=edCmt&idcmA=".$pos."&idinc=".$indPost."'>Alterar</a><br><a href='funcoes.php?acao=delComt&iccmt=".$pos."'>Excluir</a></td></tr>";
					}
				}
			}
			return $indPost;
		}else{
			alertaDireciona("Não foi possível encontrar os dados!", "painelIndex.php?ac=cmt");
		}
	}else{
		alertaDireciona("Você não tem permissão para acessar esta página!", "painelIndex.php?ac=cmt");
	}
}
function adminListarPost(){
	$dados = lerArquivoPost();
	
	for ($i=count($dados)-1; $i>=0; $i--){
		$postTitulo    = $dados->postagem[$i]->titulo;
		$postContent   = $dados->postagem[$i]->conteudo;
		$postData      = $dados->postagem[$i]->data;
		$postTipo      = $dados->postagem[$i]->tipoPostagem;
			
		echo "<tr>
				<td align='left'>$postTitulo</td>
				<td align='left'>$postContent</td>
				<td align='center'>$postData</td>
				<td align='center'>$postTipo</td>
				<td align='center'><a href='painelIndex.php?ac=altP&idP=".$i."'>Alterar</a><br><a href='funcoes.php?acao=delete&indice=".$i."'>Excluir</a></td>
			  </tr>";
		}
}
function exibirPostagemIndividual($i){
	$dados = lerArquivoPost();

	$postTitulo    = $dados->postagem[$i]->titulo;
	$postContent   = $dados->postagem[$i]->conteudo;
	$postData      = $dados->postagem[$i]->data;
	$postTipo      = $dados->postagem[$i]->tipoPostagem;
			
	echo "<tr style='font-weight:bold;text-align:center'>
			<td align='center'>Titulo</td>
			<td align='center'>Conteúdo da Postagem</td>
			<td align='center'>Data</td>
			<td align='center'>Categoria</td>
		  </tr>";
	echo "<tr>
			<td align='left'>$postTitulo</td>
			<td align='left'>$postContent</td>
			<td align='center'>$postData</td>
			<td align='center'>$postTipo</td>
		  </tr>";
	
}
function retornoPostagemIndividual($i){
	$dados = lerArquivoPost();

	$postTitulo    = $dados->postagem[$i]->titulo;
	$postContent   = $dados->postagem[$i]->conteudo;
	$postData      = $dados->postagem[$i]->data;
	$postTipo      = $dados->postagem[$i]->tipoPostagem;
		
	return "<table border='1px' width='100%' align='center'>
		  <tr style='font-weight:bold;text-align:center'>
			<td align='center'>Titulo</td>
			<td align='center'>Conteúdo da Postagem</td>
			<td align='center'>Data</td>
			<td align='center'>Categoria</td>
		  </tr><tr>
			<td align='left'>$postTitulo</td>
			<td align='left'>$postContent</td>
			<td align='center'>$postData</td>
			<td align='center'>$postTipo</td>
		  </tr>
		  </table>";
}
function lerQuantComent($indice){
	$dadosCmt = lerArquivoCmt();
	$quantCmt = 0;
	foreach($dadosCmt->comentario as $cmt){
		if($cmt->indicePost == $indice){
			$quantCmt = $quantCmt + 1;
		}
	}
	return $quantCmt;
}
function lerQuantCurtir($indice){
	$dadosCur = lerArquivoCur();
	$quantCur = 0;
	foreach($dadosCur->postagem as $cur){
		if($cur->indice == $indice){
			$quantCur = $quantCur + 1;
		}
	}
	return $quantCur;
}
function postExibicaoComent(){
	@session_start();
	$dados = lerArquivoPost();
	echo "<table align='center' cellspacing='0px' border='1px' width='98%'>
        <tr align='center' style='font-weight:bold;'>
			<td>Título da Postagem</td>
			<td>Conteúdo da Postagem</td>
			<td>Categoria</td>
			<td width='120px'>Comentários</td>
		</tr>";
	$dadosCmt = lerArquivoCmt();
	$quantCmt = array();
	foreach($dadosCmt->comentario as $cmt){
		$indice = intval($cmt->indicePost);
		if(!isset($quantCmt[$indice])){
			$quantCmt[$indice] = 0;
		}else{
			$quantCmt[$indice] = $quantCmt[$indice] + 1;
		}
	}
	for ($i=count($dados)-1; $i>=0; $i--){
		$postTitulo    = $dados->postagem[$i]->titulo;
		$postContent   = $dados->postagem[$i]->conteudo;
		$categoria     = $dados->postagem[$i]->tipoPostagem;
		$quant         = $quantCmt[$i];
		if(isset($quant)){
			$quant++;			
		}
		if(isset($_SESSION['indice']) && lerNivelAcesso($_SESSION['indice']) == 1){
			$vis = "<a href='painelIndex.php?ac=edCmt&idcm=$i'>$quant Comentários</a><br>";
		}else{
			$vis = "";	
		}
		echo "<tr>
				<td align='left'>$postTitulo</td>
				<td align='left'>$postContent</td>
				<td align='center'>$categoria</td>
				<td align='center'>$vis<a href='painelIndex.php?ac=edCmt&idinc=$i' style='text-decoration:none'><input type='button' style='cursor:pointer;' id='cmtInc' name='cmtInc' value=' Incluir '></a></td>
			  </tr>";
	}
	echo "</table><br>";
}
function converteNumMes($valor){
	switch($valor){
		case '01':
			$mes = 'Jan';
		break;
		
		case '02':
			$mes = 'Fev';
		break;

		case '03':
			$mes = 'Mar';
		break;

		case '04':
			$mes = 'Abr';
		break;

		case '05':
			$mes = 'Mai';
		break;

		case '06':
			$mes = 'Jun';
		break;

		case '07':
			$mes = 'Jul';
		break;

		case '08':
			$mes = 'Ago';
		break;

		case '09':
			$mes = 'Set';
		break;

		case '10':
			$mes = 'Out';
		break;

		case '11':
			$mes = 'Nov';
		break;

		case '12':
			$mes = 'Dez';
		break;
	}
	return $mes;
}

function filtrarCategoria($cat){
	$dados = lerArquivoPost();
	$op = 0;
	for ($i=count($dados)-1; $i>=0; $i--){
		if($cat == $dados->postagem[$i]->tipoPostagem){
			$postAutor	   = $dados->postagem[$i]->nomePost;
			$postDia	   = substr($dados->postagem[$i]->data,0,2);
			$postMes	   = converteNumMes(substr($dados->postagem[$i]->data,3,2));
			$postTitulo    = $dados->postagem[$i]->titulo;
			$postContent   = $dados->postagem[$i]->conteudo;
			$postHora	   = substr($dados->postagem[$i]->data,11,5);
			$postCat	   = $dados->postagem[$i]->tipoPostagem;
			$quantComent   = lerQuantComent($i);
			$quantCurtir   = lerQuantCurtir($i);
			
	      echo "
			<div class='bread'>Home » Categorias » $postCat</div>
			<div class='postagem'>
              <div class='boxdata'><div class='datainfo'>$postDia<br>$postMes</div></div>
              <div class='boxconteudo'>
                  <div id='linhatopo'></div>
				<div class='postit'>$postTitulo</div>
                  <div class='postinfo'>
                      <ul>
                          <li class='postautor'><span><img alt='autor' src='imagens/image004.png'></span> Por $postAutor</li>
                          <li class='infodiv'>|</li>
                          <li class='posthora'><span><img alt='hora' src='imagens/image003.png'></span> às $postHora</li>
                          <li class='infodiv'>|</li>
                          <li class='postcat'><span><img alt='tag' src='imagens/tag.png'></span> em $postCat</li>
                      </ul>
                  </div>
                  <div class='postcontent'>
                      $postContent
                  </div>
              </div>
              <div class='postfooter'>
                  <div class='email'><a href='envioPostagem.php?indice=$i'><img alt='email' title='Enviar Postagem para seu Email' src='imagens/image006.png'></a></div>
                  <div class='comments'><!--$quantComent --><img title='Comentários' alt='comments' src='imagens/image007.png'></div>
                  <div class='likes'><!--$quantCurtir--><a href='funcoes.php?acao=curtir&indice=$i'><img title='Curtir' alt='likes' src='imagens/image008.png'></a></div>
              </div>
			</div>";
		  $op++;
		}
	}
	if($op == 0){
		echo "<div class='postagem'>
			  	<div class='pagetit'><h1>Não existem Posts nesta categoria.</h1></div>
				<br><br><br><br><br><br><br><br><br><br><br><br>
			  </div>";
	}
}

function postExibicao(){
	$dados = lerArquivoPost();

	for ($i=count($dados)-1; $i>=0; $i--){

		$postAutor	   = $dados->postagem[$i]->nomePost;
		$postDia	   = substr($dados->postagem[$i]->data,0,2);
		$postMes	   = converteNumMes(substr($dados->postagem[$i]->data,3,2));
		$postTitulo    = $dados->postagem[$i]->titulo;
		$postContent   = $dados->postagem[$i]->conteudo;
		$postHora	   = substr($dados->postagem[$i]->data,11,5);
		$postCat	   = $dados->postagem[$i]->tipoPostagem;
		$quantComent   = lerQuantComent($i);
		$quantCurtir   = lerQuantCurtir($i);
		
		echo "<div class='postagem'>
              <div class='boxdata'><div class='datainfo'>$postDia<br>$postMes</div></div>
              <div class='boxconteudo'>
                  <div id='linhatopo'></div>
				<div class='postit'>$postTitulo</div>
                  <div class='postinfo'>
                      <ul>
                          <li class='postautor'><span><img alt='autor' src='imagens/image004.png'></span> Por $postAutor</li>
                          <li class='infodiv'>|</li>
                          <li class='posthora'><span><img alt='hora' src='imagens/image003.png'></span> às $postHora</li>
                          <li class='infodiv'>|</li>
                          <li class='postcat'><span><img alt='tag' src='imagens/tag.png'></span> em $postCat</li>
                      </ul>
                  </div>
                  <div class='postcontent'>
                      $postContent
                  </div>
              </div>
              <div class='postfooter'>
                  <div class='email'><a href='envioPostagem.php?indice=$i'><img alt='email' title='Enviar Postagem para seu Email' src='imagens/image006.png'></a></div>
                  <div class='comments'><a href='postInterno.php?ac=edCmt&idcm=$i'><img  title='Comentários' alt='comments' src='imagens/image007.png'></div>
                  <div class='likes'><a href='funcoes.php?acao=curtir&indice=$i'><img title='Curtir' alt='likes' src='imagens/image008.png'></a></div>
              </div>
          </div>";
	}
}


?>