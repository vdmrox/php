<?php

print "DIgite um n�mero qualquer: ";
$x = trim(fgets(STDIN));
$y = $x;

while ($x != 0){
	print "Digite outro n�mero, ou 0 (zero) para terminar: ";
	$x = trim(fgets(STDIN));
	if ($x > $y){
		$y = $x;
	}
}
print "O maior n�mero digitado foi " . $y;
?>