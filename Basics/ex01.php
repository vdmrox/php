<?php
print "Digite um número inteiro: ";
$x = trim(fgets(STDIN));

while ($x != 0){
	print "Digite outro número inteiro, porque esse num tá bom: ";
	$x = trim(fgets(STDIN));
}
?>