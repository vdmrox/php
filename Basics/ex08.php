<?php
print "Digite um valor inteiro positivo: ";
$valor = trim(fgets(STDIN));
$i = $valor;

for ($i = 0; $i < $valor; $i++){
	print "*\n";
}

print "fim do programa."

?>