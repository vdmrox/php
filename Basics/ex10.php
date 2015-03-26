<?php
print "Digite um número inteiro positivo: ";
$fator = trim(fgets(STDIN));

for ($i = 1; $i <= 10; $i++){
	$result = $fator * $i;
	print $fator . " x " . $i . " = " . $result . "\n";
}

print "Fim do programa";
?>