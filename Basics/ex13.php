<?php
print "Quanto valores inteiros voc� vai digitar? ";
$n = trim(fgets(STDIN));
$soma = 0;
$divpar = 0;

for ($i = 1; $i <= $n; $i++){
	print "Digite o " . $i . "� valor: ";
	$valor = trim(fgets(STDIN));
	
	if ($valor % 2 == 0){
		$soma = $soma + $valor;
		$divpar = $divpar + 1;
	}
}

$media = $soma / $divpar;

print "soma = " . $soma . "\n";
print "A m�dia dos n� pares � igual a " . $media . "\n";
print "Fim do programa."

?>