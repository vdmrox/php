/*---------------------------------------------------------------------------------------
  Framework para javascript - jwifi
  Desenvolvedor: Wilton de Paula Filho
  Data: Novembro de 2011
  Contatos: http://www.wiltonfilho.com; wiltonpaulafilho@gmail.com
---------------------------------------------------------------------------------------*/


/****************************************************************************************
  Funcao: mudarEstilosInputs
  Objetivo: Mudar o estilo (CSS) de todos os inputs disponíveis na página cujos conteudos
	   forem iguais a valorRef (atributo)
  Parametros:
  		- tipoTag: tipo de tag a ser validada. Ex: input, textarea, select
  		- tipoInput: tipo de campo a ser validado. Ex: text, button, etc
		- valorRef: valor utilizado como referência para alteração de estilos
		- nomeClasse: classe em CSS contendo o estilo a ser aplicado a cada um dos inputs
  Retorno: nenhum
  Exemplos de chamada de função: 
  		- mudarEstilosInputs('input','text','','inputTextErro'); 
		- mudarEstilosInputs('input','button','','inputTextErro'); 
		- mudarEstilosInputs('textarea','textarea','','inputTextErro'); 
****************************************************************************************/
function mudarEstilosInputs(tipoTag, tipoInput, valorRef, nomeClasse) {
	var nroCampos = document.getElementsByTagName(tipoTag).length;

	for (i=0; i<nroCampos; i++) {
			if (tipoInput == "button") {
				if (document.getElementsByTagName(tipoTag)[i].type == tipoInput)
					document.getElementsByTagName(tipoTag)[i].className=nomeClasse;
			}
			else if (document.getElementsByTagName(tipoTag)[i].value == valorRef)
					document.getElementsByTagName(tipoTag)[i].className=nomeClasse;
	}
}

/****************************************************************************************
  Funcao: inserirMascara
  Objetivo: Insere qualquer mascara em um campo qualquer a medida que o usuário for 
  				digitando a informação
  Parametros:
  		- idCampo: id do campo onde sera aplicada a mascara
		- mascara: mascara do campo. Ex: dd/mm/aaaa, xxx.xxx.xxx-yy, (000)0000-0000
  Retorno: nenhum
  Exemplos de chamada de função: 
  		- inserirMascara('txtData','dd/mm/aaaa');
  		- inserirMascara('txtCPF','xxx.xxx.xxx-xx');
  		- inserirMascara('txtCEP','yy.xxx-www');
  OBS: A chamada desta funcao devera ser feita pelo manipulador de eventos onkeypress 
  de cada campo de entrada de dados. 
  Ex: <input type="text" id="txtData" onKeyPress="inserirMascara('txtData','dd/mm/aaaa')">
****************************************************************************************/
function inserirMascara(idCampo, mascara) {
	
	var tamanhoMascara = mascara.length;

	// Limita a quantidade de caracteres a ser digitada pelo usuario dentro do campo em relacao a 
	// quantidade de caracteres contidos na mascara
	if (document.getElementById(idCampo).value.length > tamanhoMascara-1)
		document.getElementById(idCampo).value = (document.getElementById(idCampo).value).substr(0,tamanhoMascara-1);
	else {

		var i;
		var vetorPosicoes = new Array(); // Vetor contendo as posicos de cada símbolo da mascara
		var vetorSimbolos = new Array(); // Vetor contendo todos os símbolos da mascara
		var padrao = /[a-zA-Z0-9]/;     // Na mascara e permitido ao usuario digitar qualquer caracater alfanumerico
	
		// Criacao de dois vetores: um contendo os simbolos da mascara e outro as posicoes de cada simbolo
		// dentro da mascara
		for (i=0; i<tamanhoMascara; i++) {
			if (mascara.charAt(i).match(padrao)==null) {
				vetorSimbolos.push(mascara.charAt(i));
				vetorPosicoes.push(i+1);
			}
		}
	
		var qtidadeSimbolos = vetorPosicoes.length;
		var qtidadePosicoes = vetorSimbolos.length;
		var tamanhoCampo = document.getElementById(idCampo).value.length;
		// Insere os simbolos na informacao digitada pelo usuário. Criação da mascara dinamicamente
		for (i=0; i<vetorPosicoes.length; i++) {
			// Caracteres insuficientes para aplicar um simbolo especifico da mascara
			if (tamanhoCampo < vetorPosicoes[i]) break; 
			else {
				var texto = document.getElementById(idCampo).value;
				if (texto[vetorPosicoes[i]-1] != vetorSimbolos[i])
					document.getElementById(idCampo).value = texto.slice(0,vetorPosicoes[i]-1) + vetorSimbolos[i] + texto.slice(vetorPosicoes[i] - 1);
			}
		}
	}
}