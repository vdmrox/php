<?php
print "Digite um n�mero:";
$x = trim(fgets(STDIN));
$y = 0;
$i = 0;

while ($x != 0){
	$y = $x + $y;
	$i = $i+1;
	print "Digite um n�mero:";
	$x = trim(fgets(STDIN));
}

$media = $y / $i;
print "A m�dia entre os n�meros � igual a " . $media . ".";

?>