<?php
print "Digite um número:";
$x = trim(fgets(STDIN));
$y = 0;

while ($x != 0){
	$y = $x + $y;
	print "Digite outro número:";
	$x = trim(fgets(STDIN));
}

print "A soma dos número é igual a " . $y . ".";
?>