
function Certo(id){

	document.getElementById(id).style.borderColor="#f00";
	document.getElementById(id).style.borderWidth="1px";
	document.getElementById(id).style.borderStyle="solid";
	
}

function Errado(id){

	document.getElementById(id).style.borderColor="#bbb";
	document.getElementById(id).style.borderWidth="1px";
	document.getElementById(id).style.borderStyle="solid";
	
}

function validarTudo(){
	
	var nome = document.getElementById('nome').value;
	var email = document.getElementById('email').value;
	var senha = document.getElementById('senha').value;
	var data = document.getElementById('nascimento').value;
	var cidade = document.getElementById('cidade').value;
	var estado = document.getElementById('estado').value;

	
	var aviso00 = "";
	var aviso01 = "";
	var aviso02 = "";
	var aviso03 = "";
	var aviso04 = "";
	var aviso05 = "";
	var aviso06 = "";
	
	
	if(nome.length<3)
	{
	
		var aviso00 = 'O nome deve possuir mais de três caracteres.\n';
		Certo('nome');
		
	}else{

		Errado('nome');

	}
	
    var padrao=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
    if(padrao.test(email) == false)
	{         
		var aviso01 = 'O email não foi preenchido não é válido.\n';
		Certo('email');
		
	}else{

		Errado('email');
    }
	
	
	if(senha.length<8)
	{
		var aviso02 = 'A senha deve ter no mínimo 8 caractéres.\n';
		Certo('senha');
		
	}else{

		Errado('senha');
	}
	
	
	
	var padrao=/^(.*(([^a-z1-9]+.*\d+)|(\d+.*[^a-z1-9]+)).*)$/;
	if(padrao.test(senha) == false)
	{
		var aviso03 = 'A senha precisa conter números e letras maiúsculas.\n';
		Certo('senha');
		
	}else{

		Errado('senha');
	}
	
	var padrao=/^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
	if(padrao.test(data) == false)
	{
		var aviso04 = 'A data não é válida, utilize o formato "DD/MM/AAAA".\n';
		Certo('nascimento');
		
	}else{

		Errado('nascimento');
		
	}
	
	if(cidade.length<4){
	
		var aviso05 = 'O campo Cidade não foi preenchido corretamente.\n';
		Certo('cidade');
		
	}else{

		Errado('cidade');
	}
	
	if(estado.length<2){
	
		var aviso06 = 'O campo Estado não foi preenchido corretamente.\n';
		Certo('estado');
		
	}else{

		Errado('estado');
	}
	
	var comp_avisos = aviso00 + aviso01 + aviso02 + aviso03 + aviso04 + aviso05 + aviso06;
	

	if(comp_avisos.length == 0){
	
		document.getElementById("incluir").submit();
	
	}else{
	
		window.alert(comp_avisos);

	}
}


function Validar_contato(){
		
		
	var nome = document.getElementById('camponome').value;
	var email = document.getElementById('campoemail').value;
	var telefone = document.getElementById('campotelefone').value;
	var assunto = document.getElementById('campoassunto').value;
	var msg = document.getElementById('campomsg').value;

	
	var aviso00 = "";
	var aviso01 = "";
	var aviso02 = "";
	var aviso03 = "";
	var aviso04 = "";
	
	
	if(nome.length<3)
	{
		var aviso00 = 'O nome deve possuir mais de três caracteres.\n';

	}

	var padrao=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
    if(padrao.test(email) == false)
	{         
		var aviso01 = 'O email não foi preenchido não é válido.\n';

    }
	
	if(assunto.length==0)
	{
		var aviso02 = 'O Assunto não foi preenchido.\n';

	}
	
	if(msg.length==0)
	{
		var aviso03 = 'A mensagem não foi preenchida.\n';

	}
	
	var comp_avisos = aviso00 + aviso01 + aviso02 + aviso03 + aviso04;
	

	if(comp_avisos.length == 0){
	
		document.getElementById("formcontato").submit();
	
	}else{
	
		window.alert(comp_avisos);

	}
}