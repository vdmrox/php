<?php

print "DIgite um número qualquer: ";
$x = trim(fgets(STDIN));
$y = $x;

while ($x != 0){
	print "Digite outro número, ou 0 (zero) para terminar: ";
	$x = trim(fgets(STDIN));
	if ($x > $y){
		$y = $x;
	}
}
print "O maior número digitado foi " . $y;
?>