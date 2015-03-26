<?php
print "Quantos números você quer digitar? ";
$div = trim(fgets(STDIN));
$soma = 0;

for ($i = 1; $i <= $div; $i++){
	print "digite o valor " . $i . ": ";
	$valor = trim(fgets(STDIN));
	$soma = $soma + $valor;
}

$med = $soma / $div;

print "A média dos valores digitados é igual a " . $med;

?>