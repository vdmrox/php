<?php
print "Digite um valor qualquer (multiplicador): ";
$x = trim(fgets(STDIN));
print "Digite outro valor (limitador): ";
$n = trim(fgets(STDIN));

for ($i = 0; $i <= $n; $i++){
	$result = $x * $i;
	print  $i . " x " . $x . " = " . $result . "\n";
}

?>