<?php

//include "../includes/funcoes.php";

$email   = $_POST['campoemail'];
$nome    = $_POST['camponome'];
$fone    = $_POST['campotelefone'];
$assunto = $_POST['campoassunto'];
$msg     = $_POST['campomsg'];


$mensagem = "Contato<br><br>Nome: ".$nome."<br>Email: ".$email."<br>Telefone: ".$fone."<br>Assunto: ".$assunto."<br><br>Mensagem: ".$msg;
//echo $mensagem;

// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
require("class.phpmailer.php");

// Inicia a classe PHPMailer
$mail = new PHPMailer();

// Define os dados do servidor e tipo de conexão
$mail->IsSMTP();
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server

$mail->Username = 'sisnetiftm@gmail.com'; // Usuário do servidor SMTP
$mail->Password = 'sisnet2012'; // Senha do servidor SMTP

// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->From = $email; // Seu e-mail
$mail->FromName = "Café Sonzera"; // Seu nome
$mail->From = 'sisnetiftm@gmail.com';

// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->AddAddress('sisnetiftm@gmail.com');
//$mail->AddAddress('ciclano@site.net');
//$mail->AddCC('contato@2dolls.com.br', 'Contato 2dolls'); // Copia
//$mail->AddBCC('felipegomesudi@gmail.com', 'Felipe Gomes'); // Cópia Oculta

// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)

// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->Subject  = 'Contato: Café Sonzera'; // Assunto da mensagem
$mail->Body = $mensagem;
$mail->AltBody = "Este é o corpo da mensagem de teste, em Texto Plano! \r\n";

// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo

// Envia o e-mail
$enviado = $mail->Send();

// Limpa os destinatários e os anexos
$mail->ClearAllRecipients();
$mail->ClearAttachments();

// Exibe uma mensagem de resultado
if ($enviado) {
	echo "<script type=\"text/javascript\">";
	echo "alert('Mensagem enviada com Sucesso!');";
	echo "document.location=('../index.php');";
	echo "</script>";

} else {
echo "Não foi possível enviar o e-mail.<br /><br />";
echo "<b>Informações do erro:</b> <br />" . $mail->ErrorInfo;
}

?>