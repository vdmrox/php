<?php
print "Digite um número para a base:";
$a = trim(fgets(STDIN));

print "Digite um número para o expoente:";
$b = trim(fgets(STDIN));

while ($b < 0){
	print "O expoente deve ser não negativo:";
	$b = trim(fgets(STDIN));
}

$result = pow($a, $b);
print "Parabéns! O resultado é " . $result . ".";
?>