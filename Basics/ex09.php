<?php
print "Digite um n�mero inteiro positivo: ";
$valor = trim(fgets(STDIN));
$i = $valor;

for($i = 1; $i <= $valor; $i++){
	print $i . "\n";
}

print "Fim do programa!";
?>