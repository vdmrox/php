<?php
print "Digite um número:";
$x = trim(fgets(STDIN));
$y = 0;
$i = 0;

while ($x != 0){
	$y = $x + $y;
	$i = $i+1;
	print "Digite um número:";
	$x = trim(fgets(STDIN));
}

$media = $y / $i;
print "A média entre os números é igual a " . $media . ".";

?>