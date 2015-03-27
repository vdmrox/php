<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="blog.css" rel="stylesheet">
<title>Café Sonzera :: Música e bom papo</title>
</head>

<body>

<?php
 @session_start();
 include "funcoes.php"; ?>

<div id="blog">
  <div id="leftcol">
      <div id="menu">
          <div id="menuleft"></div>
          <div id="menucenter">
              <ul>
                  <li><a href="index.php">home</a></li>
                  <li><a href="sobre.php">sobre</a></li>
                  <li>categorias
                    <ul class="submenu">
                      <li><a href="index.php?cat=dicas">Dicas</a></li>
                      <li><a href="index.php?cat=noticias">Notícias</a></li>
                      <li><a href="index.php?cat=review">Review</a></li>
                      <li><a href="index.php?cat=shows">Shows</a></li>
                    </ul>
                  </li>
                  <li><a href="cadastro.php">cadastro</a></li>
                  <li><a href="contato.php">contato</a></li>
              </ul>
          </div>
          <div id="menuright" ></div>
      </div>
      <div id="container">
      
          <!-------------------- Início do loop de postagens -------------------->
          <?php 
		  	if (isset($_GET['cat'])){
				$cat = $_GET['cat'];
				filtrarCategoria($cat);
			}else{
		  		postExibicao();
            }
		  ?>
          
          <!-------------------- Fim do loop de postagens -------------------->
      </div>
      <div id="footer">
          <div id="footerimg"></div>
          <p id="copyright">© Copyright 2013 Café Sonzera. Todos os direitos reservados.</p>
      </div>
  </div>
  
  <!-------------------- Coluna da direita -------------------->
  
  <div id="rightcol">
      <div id="logo"><img src="imagens/image001.png"></div>
      
      <!-------------------- Resumo -------------------->
      
      <div id="resumo">
          <h2>Um pouco sobre a gente</h2>
          <div class="divline"><img alt="divisoria" src="imagens/divline.jpg"></div>
          <div class="wtext">
              Seja bem vindo ao Café Sonzera. Aqui você vai encontrar informações sobre o mundo da música em geral, 
					mas em particular, muita coisa sobre o velho e bom Rock' n Roll.
              <br><br>
              <span><a href="sobre.php">Leia Mais »</a></span>
          </div>
      </div>
      
      <!-------------------- Formulário de Login -------------------->
      
      <div id="login">
          <h2>Login</h2>
          <div class="divline"><img alt="divisoria" src="imagens/divline.jpg"></div>
          <?php 
		  	if(isset($_SESSION['indice'])){
				$nome = lerNome(intval($_SESSION['indice']));
				echo "<div><br>Seja bem vindo, $nome.<br><br>";
		  ?>
            <a href="painelIndex.php">Clique aqui para acessar o <br> Painel Administrativo</a></div>
		  <?php
			}else{
			
		  ?>
          <table>
              <form id="login" name="form" action="painelLogin.php" method="post">
                  <tr><td class="formtxt"><input type="text" id="usuario" name="usuario_blog" placeholder="Usuário"></td></tr>
                  <tr><td class="formtxt"><input type="password" id="pwd" name="senha_blog" placeholder="Senha"></td>
                      <td class="formbtn"><input type="submit" src="imagens/image010.png" id="envialogin" name="envialogin" value=""></td></tr>
              </form>
          </table>
          <?php 
			}
			
		  ?>
          </div>
  
      <!-------------------- Formulário de Busca -------------------->
      
      <div id="busca">
          <h2>Busca</h2>
          <div class="divline"><img alt="divisoria" src="imagens/divline.jpg"></div>
          <table>
              <form id="formbusca" name="formbusca" action="" method="get">
                  <tr><td class="formtxt"><input type="text" id="campobusca" name="campobusca" placeholder="O que você procura?"></td>
					  <td class="formbtn"><input type="submit" src="imagens/image010.png" id="enviabusca" name="enviabusca" value=""></td></tr>
              </form>
          </table>
      </div>
      <div id="categorias">
          <h2>Categorias</h2>
          <div class="divline"><img alt="divisoria" src="imagens/divline.jpg"></div>
          <ul>
              <li><a href="index.php?cat=dicas">Dicas</a></li>
              <li><a href="index.php?cat=noticias">Notícias</a></li>
              <li><a href="index.php?cat=review">Review</a></li>
              <li><a href="index.php?cat=shows">Shows</a></li>
          </ul>
      </div>
  </div>

</body>
</html>
