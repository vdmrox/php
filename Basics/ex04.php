<?php
print "Digite um n�mero:";
$x = trim(fgets(STDIN));
$y = 0;

while ($x != 0){
	$y = $x + $y;
	print "Digite outro n�mero:";
	$x = trim(fgets(STDIN));
}

print "A soma dos n�mero � igual a " . $y . ".";
?>