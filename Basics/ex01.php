<?php
print "Digite um n�mero inteiro: ";
$x = trim(fgets(STDIN));

while ($x != 0){
	print "Digite outro n�mero inteiro, porque esse num t� bom: ";
	$x = trim(fgets(STDIN));
}
?>