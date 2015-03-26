<?php
print "Digite um número real: ";
$num = trim(fgets(STDIN));

while ($num < 30000){
	print $num."\n";
	$num = $num * 2;
}
?>