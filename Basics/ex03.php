<?php
print "Digite um n�mero para a base:";
$a = trim(fgets(STDIN));

print "Digite um n�mero para o expoente:";
$b = trim(fgets(STDIN));

while ($b < 0){
	print "O expoente deve ser n�o negativo:";
	$b = trim(fgets(STDIN));
}

$result = pow($a, $b);
print "Parab�ns! O resultado � " . $result . ".";
?>